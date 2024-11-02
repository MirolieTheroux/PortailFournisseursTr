<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\WorkSubcategory;
use App\Models\ProductService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SupplierUpdateStatusRequest;
use Illuminate\Support\facades\Crypt;

class SuppliersController extends Controller
{
  const SUPPLIER_FETCH_LIMIT = 100;

  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $suppliers = Supplier::limit(self::SUPPLIER_FETCH_LIMIT)->get();
    $workSubcategories = WorkSubcategory::all();
    $productsServices = ProductService::all();
    return View('suppliers.index', compact('suppliers', 'workSubcategories', 'productsServices'));
  }

  public function selectedList(Request $request){
    if($request->filled('suppliers') && is_array($request->suppliers)){
      $suppliers = Supplier::whereIn('id', $request->suppliers)->get();
      return View('suppliers.selectedList', compact('suppliers'));
    }
    else{
      return redirect()->route('suppliers.index')->with('errorMessage',__('index.noSelection'));
    }
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   */
  public function show(Supplier $supplier)
  {

    $supplierWithProductsCategories = $supplier->load('productsServices.categories');

    $suppliersGroupedByNatureAndCategory = $supplierWithProductsCategories->productsServices->groupBy(function ($product) {
      return $product->categories->nature;
    })->map(function ($groupedByNature) {
      return $groupedByNature->groupBy(function ($product) {
        return $product->categories->code;
      })->map(function ($groupedByCategory) {
        return [
          'category_name' => $groupedByCategory->first()->categories->name,
          'products' => $groupedByCategory
        ];
      });
    });

    if (!is_null($supplier->latestNonModifiedStatus()->refusal_reason)) {
      $decryptedReason = Crypt::decryptString($supplier->latestNonModifiedStatus()->refusal_reason);
      $refusalReason = trim(unserialize($decryptedReason));
      Log::debug($refusalReason);
    }
    else
      $refusalReason = '';

    return View('suppliers.show', compact('supplier', 'suppliersGroupedByNatureAndCategory', 'refusalReason'));
  }
  
  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    
  }

  /**
   * Update status of supplier.
   */
  public function updateStatus(SupplierUpdateStatusRequest $request, Supplier $supplier)
  {
    //--ETAT DEMANDE--//
    $user = Auth::user()->email;
    Log::debug($user);
    Log::debug($supplier);
    Log::debug($request);
    $supplier->statusHistories->status = $request->requestStatus;
    $supplier->statusHistories->updated_by = $user;
    if($request->deniedReason){
      $supplier->statusHistories->refusal_reason = Crypt::encrypt($request->deniedReason);
    }
    $supplier->statusHistories->supplier_id = $supplier->id;
    $supplier->statusHistories->created_at = $supplier->id;
    // $supplier->save();
    //ramener à la bonne section
    return redirect()->route('suppliers.show', ['supplier' => $supplier->id]);
  }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function filter(Request $request)
    {
        Log::debug($request);
        $suppliersQuery = Supplier::query();
        $workCategoriesQuery = WorkSubcategory::query();
        $productsServicesQuery = ProductService::query();

        if($request->filled('name')){
            $suppliersQuery->where('name', 'like',  '%' . $request->name .'%');
        }

        if ($request->filled('cities') && is_array($request->input('cities'))) {
            $suppliersQuery->whereHas('address', function($q) use($request){
                $cities = $request->cities; 
                $q->whereIn('city', $cities);
            });
        }

        if ($request->filled('districtAreas') && is_array($request->input('districtAreas'))) {
            $suppliersQuery->whereHas('address', function($q) use($request){
                $districtAreas = $request->districtAreas; 
                $q->whereIn('region', $districtAreas);
            });
        }

        if ($request->filled('workCategories') && is_array($request->input('workCategories'))) {
            $suppliersQuery->whereHas('workSubcategories', function($q) use($request){
                $workCategories = $request->workCategories; 
                $q->whereIn('code', $workCategories);
            });
            $workCategoriesQuery->whereIn('code',$request->workCategories);
        }

        if ($request->filled('produits_services') && is_array($request->input('produits_services'))) {
            $suppliersQuery->whereHas('productsServices', function($q) use($request){
                $produits_services = $request->produits_services; 
                $q->whereIn('code', $produits_services);
            });
            $productsServicesQuery->whereIn('code',$request->produits_services);
        }

        if($request->filled('status') && is_array($request->input('status'))){
            $suppliers = $suppliersQuery->with('address')->limit(self::SUPPLIER_FETCH_LIMIT)->get()->filter(function ($supplier) use ($request){
                return in_array($supplier->latestNonModifiedStatus()->status, $request->status);
            });
        }
        else{
            $suppliers = $suppliersQuery->with('address')->limit(self::SUPPLIER_FETCH_LIMIT)->get();
        }

        $workSubcategories = $workCategoriesQuery->get();
        $productsServices = $productsServicesQuery->get();
        
        return response()->json([
            'html' => view('suppliers.components.supplierList', compact('suppliers', 'workSubcategories', 'productsServices'))->render(),
        ]);
    }

    public function waitingSuppliers(){
        Log::debug("test");

        $suppliers = Supplier::with('address')->limit(self::SUPPLIER_FETCH_LIMIT)->get()->filter(function ($supplier) {
            return $supplier->latestNonModifiedStatus()->status === "waiting";
        });
        
        $workSubcategories = WorkSubcategory::all();
        $productsServices = ProductService::all();

        return response()->json([
            'html' => view('suppliers.components.supplierList', compact('suppliers', 'workSubcategories', 'productsServices'))->render(),
        ]);
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        $offset = $request->input('offset', 1); // Get the offset value, default to 0
        $limit = $request->input('limit', 50); // Get the limit value, default to 50

        // Remove accents from search term
        $normalizedSearchTerm = str_replace(
            ['À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'à', 'á', 'â', 'ã', 'ä', 'å', 'È', 'É', 'Ê', 'Ë', 'è', 'é', 'ê', 'ë', 'Ì', 'Í', 'Î', 'Ï', 'ì', 'í', 'î', 'ï', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'Ù', 'Ú', 'Û', 'Ü', 'ù', 'ú', 'û', 'ü', 'Ç', 'ç', 'Ñ', 'ñ'], 
            ['A', 'A', 'A', 'A', 'A', 'A', 'a', 'a', 'a', 'a', 'a', 'a', 'E', 'E', 'E', 'E', 'e', 'e', 'e', 'e', 'I', 'I', 'I', 'I', 'i', 'i', 'i', 'i', 'O', 'O', 'O', 'O', 'O', 'O', 'o', 'o', 'o', 'o', 'o', 'o', 'U', 'U', 'U', 'U', 'u', 'u', 'u', 'u', 'C', 'c', 'N', 'n'],
            $searchTerm
        );

        // Get total count of matching services (without limiting)
        $total_count = ProductService::whereRaw("LOWER(CONVERT(code USING utf8mb4)) COLLATE utf8mb4_unicode_ci LIKE ?", ["%{$normalizedSearchTerm}%"])
            ->orWhere(function ($query) use ($normalizedSearchTerm) {
                $query->whereRaw("LOWER(CONVERT(description USING utf8mb4)) COLLATE utf8mb4_unicode_ci LIKE ?", ["%{$normalizedSearchTerm}%"]);
            })
            ->count();

        // Get filtered services with limit of 50
        $services = ProductService::whereRaw("LOWER(CONVERT(code USING utf8mb4)) COLLATE utf8mb4_unicode_ci LIKE ?", ["%{$normalizedSearchTerm}%"])
            ->orWhere(function ($query) use ($normalizedSearchTerm) {
                // Exact matches with description normalization
                $query->whereRaw("LOWER(CONVERT(description USING utf8mb4)) COLLATE utf8mb4_unicode_ci LIKE ?", ["% {$normalizedSearchTerm} %"])
                    ->orWhereRaw("LOWER(CONVERT(description USING utf8mb4)) COLLATE utf8mb4_unicode_ci LIKE ?", ["{$normalizedSearchTerm} %"])
                    ->orWhereRaw("LOWER(CONVERT(description USING utf8mb4)) COLLATE utf8mb4_unicode_ci LIKE ?", ["% {$normalizedSearchTerm}"])
                    ->orWhereRaw("LOWER(CONVERT(description USING utf8mb4)) COLLATE utf8mb4_unicode_ci = ?", [$normalizedSearchTerm]);
            })
            ->orWhere(function ($query) use ($normalizedSearchTerm) {
                // Partial matches anywhere in the description with normalization
                $query->whereRaw("LOWER(CONVERT(description USING utf8mb4)) COLLATE utf8mb4_unicode_ci LIKE ?", ["%{$normalizedSearchTerm}%"]);
            })
            ->orderByRaw("CASE 
                WHEN LOWER(CONVERT(description USING utf8mb4)) COLLATE utf8mb4_unicode_ci LIKE '{$normalizedSearchTerm}' THEN 1
                WHEN LOWER(CONVERT(description USING utf8mb4)) COLLATE utf8mb4_unicode_ci LIKE '{$normalizedSearchTerm} %' THEN 2
                WHEN LOWER(CONVERT(description USING utf8mb4)) COLLATE utf8mb4_unicode_ci LIKE '% {$normalizedSearchTerm} %' THEN 3
                WHEN LOWER(CONVERT(description USING utf8mb4)) COLLATE utf8mb4_unicode_ci LIKE '% {$normalizedSearchTerm}' THEN 4
                ELSE 5 
            END")
            ->orderByRaw("POSITION('{$normalizedSearchTerm}' IN LOWER(CONVERT(description USING utf8mb4)) COLLATE utf8mb4_unicode_ci) ASC")
            ->offset($offset)
            ->take($limit) // Limit results for performance
            ->get();

        // Return both the services and the total count
        return response()->json([
            'services' => $services,
            'total_count' => $total_count
        ]);
    }
}
