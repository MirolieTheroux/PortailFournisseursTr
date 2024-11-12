<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\StatusHistory;
use App\Models\WorkSubcategory;
use App\Models\ProductService;
use App\Models\Contact;
use App\Models\PhoneNumber;
use App\Models\RbqLicence;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\SupplierUpdateStatusRequest;
use App\Http\Requests\SupplierDenialRequest;
use App\Http\Requests\SupplierUpdateContactsRequest;
use App\Http\Requests\SupplierUpdateIdentificationRequest;
use App\Http\Requests\SupplierUpdateRbqRequest;

use Illuminate\Support\facades\Crypt;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;
use Symfony\Component\ErrorHandler\Debug;
use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\Mail;
use App\Mail\ApprovalMail;

class SuppliersController extends Controller
{
  const SUPPLIER_FETCH_LIMIT = 100;
  const USING_FILESTREAM = false;

  /**
   * Display a listing of the resource.
   */
  public function index()
  { 
    $suppliersQuery = Supplier::query();

    $suppliers = $suppliersQuery->with('address')->limit(self::SUPPLIER_FETCH_LIMIT)->get()->filter(function ($supplier){
      return $supplier->latestNonModifiedStatus()->status != 'deactivated';
    });

    $workSubcategories = WorkSubcategory::all();
    $productsServices = ProductService::limit(self::SUPPLIER_FETCH_LIMIT)->get();
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
    $workSubcategories = WorkSubcategory::all();

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
  
    $formattedPhoneNumbersContactDetails = $supplier->phoneNumbers->map(function ($phoneNumber) {
      return (object) [
        'type' => $phoneNumber->type,
        'number' => preg_replace('/(\d{3})[^\d]*(\d{3})[^\d]*(\d{4})/', '$1-$2-$3', $phoneNumber->number),
        'extension' => $phoneNumber->extension
      ];
    });
    $formattedPhoneNumbersContacts = $supplier->contacts->map(function ($contact) {
      $contact->formattedPhoneNumbers = $contact->phoneNumbers->map(function ($phoneNumber) {
          return (object) [
              'type' => $phoneNumber->type,
              'number' => preg_replace('/(\d{3})[^\d]*(\d{3})[^\d]*(\d{4})/', '$1-$2-$3', $phoneNumber->number),
              'extension' => $phoneNumber->extension
          ];
      });
      return $contact;
    });

    $statusHistory = $supplier->statusHistories()->orderBy('created_at','asc')->get();
    $decryptedReasons = $statusHistory->map(function ($history){
      $deniedReason = "";
      if(!is_null($history->refusal_reason))
        $deniedReason = trim(unserialize(Crypt::decryptString($history->refusal_reason)));
      else
        $deniedReason = "";
      return(object)[
        'id' => $history->id,
        'status' => $history->status,
        'updated_by' => $history->updated_by,
        'refusal_reason' => $deniedReason,
        'supplier_id' => $history->supplier_id,
        'created_at' => $history->created_at,
        'updated_at' => null
      ];
    });
    $deniedStatus = $decryptedReasons->filter(function ($history) {
      return $history->status === 'denied';
    });
    
    $latestDeniedReason = $deniedStatus->sortByDesc('created_at')->first();
    
    return View('suppliers.show', compact('supplier', 'suppliersGroupedByNatureAndCategory', 'formattedPhoneNumbersContactDetails','formattedPhoneNumbersContacts', 'decryptedReasons','latestDeniedReason', 'workSubcategories'));
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
  public function updateStatus(SupplierUpdateStatusRequest $request, Supplier $supplier, StatusHistory $statusHistory)
  {
    try {
      $user = Auth::user()->email;
      $statusHistory->status = $request->requestStatus;
      $statusHistory->updated_by = $user;
      if ($request->requestStatus === "denied" && !empty($request->deniedReasonText)) {
        $statusHistory->refusal_reason = Crypt::encrypt($request->deniedReasonText);
      }
      
      $statusHistory->supplier_id = $supplier->id;
      $statusHistory->created_at = Carbon::now('America/Montreal');
      $statusHistory->save();

      if ($request->requestStatus == "denied") {
        $this->destroyAttachments($supplier);
      }

      return redirect()->route('suppliers.show', ['supplier' => $supplier->id])
      ->with('message',__('show.successUpdateStatus'));
    } catch (\Throwable $e) {
      Log::debug($e);
      return redirect()->route('suppliers.show', ['supplier' => $supplier->id])
        ->withErrors('message',__('show.failToUpdate'));
    }
  }
  

  /**
   * Update identification of supplier.
   */
  public function updateIdentification(SupplierUpdateIdentificationRequest $request, Supplier $supplier)
  {
    try{
      Log::debug($supplier->neq);
      Log::debug($request->neq);
      $supplier->neq = $request->neq;
      $supplier->name = $request->name;
      $supplier->email = $request->email;
      $supplier->save();

      return redirect()->route('suppliers.show', ['supplier' => $supplier->id])
      ->with('message',__('show.successUpdateIdentification'))
      ->header('Location', route('suppliers.show', ['supplier' => $supplier->id]) . '#identification-section');
    }
    catch (\Throwable $e) {
      Log::debug($e);
      return redirect()->route('suppliers.show', ['supplier' => $supplier->id])
        ->withErrors('message',__('show.failToUpdate'));
    }
    
    return redirect()->route('suppliers.show', ['supplier' => $supplier->id]);
  }

  public function denyRequest(SupplierDenialRequest $request, Supplier $supplier)
  {
    $this->changeSupplierStatusWithReason($supplier, "denied", $request->deniedReason);

    return redirect()->route('suppliers.show', ['supplier' => $supplier->id])->with('message',__('show.denialSuccess'));
  }

  public function approveRequest($id)
  {
    $supplier = Supplier::findOrFail($id);
    $this->changeStatus($supplier, "accepted");
    //$this->sendApprovalMail($supplier->email);

    return redirect()->route('suppliers.show', ['supplier' => $supplier->id])->with('message',__('show.approvalSuccess'));
  }

  public function removeFromList($id)
  {
    $supplier = Supplier::findOrFail($id);
    $this->changeStatus($supplier, "deactivated");

    $this->destroyAttachments($supplier);

    return redirect()->route('suppliers.show', ['supplier' => $supplier->id])->with('message',__('show.removeFromListSuccess'));
  }

  public function reactivate($id){
    $supplier = Supplier::findOrFail($id);
    $this->changeStatus($supplier, $supplier->latestActivableStatus()->status);

    return redirect()->route('suppliers.show', ['supplier' => $supplier->id])->with('message',__('show.reactivationSuccess'));
  }

  private function changeStatus($supplier, $newStatus){
    $status = new StatusHistory();
    $status->status = $newStatus;
    $status->updated_by = auth()->user()->email;
    $status->created_at = Carbon::now('America/Toronto');
    $status->supplier()->associate($supplier);
    $status->save();
  }
  private function changeSupplierStatusWithReason($supplier, $newStatus, $reason){
    $status = new StatusHistory();
    $status->status = $newStatus;
    $status->updated_by = auth()->user()->email;
    $status->created_at = Carbon::now('America/Toronto');
    $status->refusal_reason = Crypt::encrypt($reason);
    $status->supplier()->associate($supplier);
    $status->save();
  }

  private function destroyAttachments($supplier)
  {
    if(!(self::USING_FILESTREAM)){
      $directory = $supplier->name;
      $path = env('FILE_STORAGE_PATH'). "\\". $directory;

      Log::debug($path);
      if (file_exists($path)) {
        File::deleteDirectory($path);
      }
    }

    $supplier->attachments()->delete();
  }

  /**
   * Update contacts of supplier.
   */
  public function updateContacts(SupplierUpdateContactsRequest $request, Supplier $supplier)
  {
    Log::debug($request);
    try {
      foreach ($supplier->contacts as $contact) {
        if(!in_array($contact->id, $request->contactIds)){
          foreach ($contact->phoneNumbers as $phoneNumber) {
            $phoneNumber->delete();
          }
          $contact->delete();
        }
      }

      for($i = 0 ; $i < Count($request->contactFirstNames) ; $i++){
        if($request->contactIds[$i] != -1){
          $contact = Contact::findOrFail($request->contactIds[$i]);
        }
        else{
          $contact = new Contact();
        }
        
        $contact->email = $request->contactEmails[$i];
        $contact->first_name = $request->contactFirstNames[$i];
        $contact->last_name = $request->contactLastNames[$i];
        $contact->job = $request->contactJobs[$i];
        $contact->supplier()->associate($supplier);
        $contact->save();

        if($request->contactTelIdsA[$i] != -1){
          $phoneNumberA = PhoneNumber::findOrFail($request->contactTelIdsA[$i]);
        }
        else{
          $phoneNumberA = new PhoneNumber();
        }
        $phoneNumberA->number = str_replace('-', '', $request->contactTelNumbersA[$i]);
        $phoneNumberA->type = $request->contactTelTypesA[$i];
        $phoneNumberA->extension = $request->contactTelExtensionsA[$i];

        if($request->contactTelIdsA[$i] == -1){
          $phoneNumberA->supplier()->associate(null);
          $phoneNumberA->contact()->associate($contact);
        }
        $phoneNumberA->save();

        if(!is_null($request->contactTelNumbersB[$i])){
          if($request->contactTelIdsB[$i] != -1){
            $phoneNumberB = PhoneNumber::findOrFail($request->contactTelIdsB[$i]);
          }
          else{
            $phoneNumberB = new PhoneNumber();
          }

          $phoneNumberB->number = str_replace('-', '', $request->contactTelNumbersB[$i]);
          $phoneNumberB->type = $request->contactTelTypesB[$i];
          $phoneNumberB->extension = $request->contactTelExtensionsB[$i];
          if($request->contactTelIdsB[$i] == -1){
            $phoneNumberB->supplier()->associate(null);
            $phoneNumberB->contact()->associate($contact);
          }
          $phoneNumberB->save();
        }
        else if(Count($contact->phoneNumbers) == 2){
          $contact->phoneNumbers[1]->delete();
        }
      }
      $this->changeStatus($supplier, "modified");

      return redirect()->route('suppliers.show', ['supplier' => $supplier->id])
      ->with('message',__('show.successUpdateContact'))
      ->header('Location', route('suppliers.show', ['supplier' => $supplier->id]) . '#contacts-section');
      
    } catch (\Throwable $e) {
      Log::debug($e);
      return redirect()->route('suppliers.show', ['supplier' => $supplier->id])->with('errorMessage',__('global.updateFailed'));
    }
  }

  /**
   * Update RBQ Licence of supplier.
   */
  public function updateRbq(SupplierUpdateRbqRequest $request, Supplier $supplier)
  {
    Log::debug($request);

    try {
      $supplierRbqExisting = !is_null($supplier->rbqLicence);
      $requestRbqExisting = !is_null($request->licenceRbq);
  
      if($supplierRbqExisting && $requestRbqExisting){
        $licence = RbqLicence::findOrFail($supplier->rbqLicence->id);
        $licence->number = $request->licenceRbq;
        $licence->status = $request->statusRbq;
        $licence->type = $request->typeRbq;
        $licence->supplier()->associate($supplier);
        $licence->save();

        foreach ($supplier->workSubcategories as $rbqSubCategory) {
          if(!in_array($rbqSubCategory->code, $request->rbqSubcategories)){
            $supplier->workSubcategories()->detach($rbqSubCategory->id);
          }
        }

        $supplierExistingCategories = $supplier->workSubcategories->pluck('code')->toArray();
        foreach ($request->rbqSubcategories as $rbqSubCategory) {
          if(!in_array($rbqSubCategory, $supplierExistingCategories)){
            $subCategory = WorkSubcategory::where('code', $rbqSubCategory)->firstOrFail();
            $supplier->workSubcategories()->attach($subCategory);
          }
        }
      }
      else if(!$supplierRbqExisting && $requestRbqExisting){
        $licence = new RbqLicence();
        $licence->number = $request->licenceRbq;
        $licence->status = $request->statusRbq;
        $licence->type = $request->typeRbq;
        $licence->supplier()->associate($supplier);
        $licence->save();
  
        foreach($request->rbqSubcategories as $rbqSubCategory){
          $subCategory = WorkSubcategory::where('code', $rbqSubCategory)->firstOrFail();
          $supplier->workSubcategories()->attach($subCategory);
        }
      }
      else if($supplierRbqExisting && !$requestRbqExisting){
        $licence = RbqLicence::findOrFail($supplier->rbqLicence->id);
        $licence->delete();

        $supplier->workSubcategories()->sync([]);
      }

      $this->changeStatus($supplier, "modified");

      return redirect()->route('suppliers.show', ['supplier' => $supplier->id])
      ->with('message',__('show.successUpdateRbq'))
      ->header('Location', route('suppliers.show', ['supplier' => $supplier->id]) . '#licence-section');
      
    } catch (\Throwable $e) {
      Log::debug($e);
      return redirect()->route('suppliers.show', ['supplier' => $supplier->id])->with('errorMessage',__('global.updateFailed'));
    }
  }

  /**
   * Update products and services of supplier.
   */
  public function updateProductsServices(Request $request, Supplier $supplier)
  {
    Log::debug($request);

    try {
      $supplier->product_service_detail = $request->product_service_detail;
      $supplier->save();

      //Code pour supprimer une categorie
      foreach ($supplier->productsServices as $productService) {
        if(!in_array($productService->code, $request->produits_services)){
          $supplier->productsServices()->detach($productService->code);
        }
      }

      //Code pour ajouter une categorie
      $supplierExistingProductsServices = $supplier->productsServices->pluck('code')->toArray();
      foreach ($request->produits_services as $productServiceCode) {
        if(!in_array($productServiceCode, $supplierExistingProductsServices)){
          $productService = ProductService::where('code', $productServiceCode)->firstOrFail();
          $supplier->productsServices()->attach($productService);
        }
      }

      return redirect()->route('suppliers.show', ['supplier' => $supplier->id])
      ->with('message',__('show.successUpdatePS'))
      ->header('Location', route('suppliers.show', ['supplier' => $supplier->id]) . '#productsServices-section');

    } catch (\Throwable $e) {
      Log::debug($e);
      return redirect()->route('suppliers.show', ['supplier' => $supplier->id])->with('errorMessage',__('global.updateFailed'));
    }

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
          $suppliers = $suppliersQuery->with('address')->limit(self::SUPPLIER_FETCH_LIMIT)->get()->filter(function ($supplier){
            return $supplier->latestNonModifiedStatus()->status != 'deactivated';
          });
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

  public function export(Request $request)
  {
    $suppliersIds = $request->input('supplierIds', []);
    $suppliers = Supplier::whereIn('id', $suppliersIds)->get();

    $selectedSupplierIds = $request->input('selectedSupplierIds', []);
    $selectedSupplierContactNames = $request->input('selectedSupplierContactNames', []);

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $sheet->mergeCells('A1:C1');
    $sheet->setCellValue('A1', __('selectedSuppliersList.exportDate') . Carbon::now('America/Toronto')->format('d-m-Y'));

    $sheet->setCellValue('A2', __('form.lastNameLabel'));
    $sheet->setCellValue('B2', __('form.emailLabel'));
    $sheet->setCellValue('C2', __('form.neqLabelShort'));
    $sheet->setCellValue('D2', __('form.contactsSubtitle'));
    $sheet->setCellValue('E2', __('selectedSuppliersList.joined'));
    
    $row = 3;
    foreach ($suppliers as $supplier) {
      $sheet->setCellValue('A' . $row, $supplier->name);
      $sheet->setCellValue('B' . $row, $supplier->email);
      $sheet->setCellValue('C' . $row, $supplier->neq);

      foreach ($selectedSupplierIds as $key=>$selectedSupplierId) {
        if($supplier->id == $selectedSupplierId){
          $sheet->setCellValue('D' . $row, $selectedSupplierContactNames[$key]);
        }
      }
      
      $contacted = in_array($supplier->id, $selectedSupplierIds) ? __('global.yes') : __('global.no');
      $sheet->setCellValue('E' . $row, $contacted);

      $row++;
    }

    foreach (range('A', 'E') as $columnID) {
      $sheet->getColumnDimension($columnID)->setAutoSize(true);
    }

    $fileName = 'fournisseurs_' . Carbon::now('America/Toronto')->format('Y-m-d_H-i-s') . '.xlsx';
    $temp_file = tempnam(sys_get_temp_dir(), $fileName);
    $writer = new Xlsx($spreadsheet);
    $writer->save($temp_file);

    return response()->download($temp_file, $fileName)->deleteFileAfterSend(true);
  }

  public function sendApprovalMail($supplierEmail){
    Log::debug($supplierEmail);
    $details = [
      'title' => 'Mail from Laravel',
      'body' => 'This is a test email.'
    ];
    Mail::to('fleurent.nicolas@hotmail.com')->send(new ApprovalMail($details));
    return "Email Sent!";
  }

  public function checkEmail(Request $request)
  {
    $email = $request->email;
    $neq = $request->neq;
    $supplierId = $request->supplierId;
    $exists = Supplier::where('neq', $neq)
                        ->where('email', $email)
                        ->when($supplierId, function ($query, $supplierId) {
                          return $query->where('id', '!=', $supplierId);
                        })
                        ->exists();
    return response()->json(['exists' => $exists]);
  }

  public function checkNeq(Request $request)
  {
    $neq = $request->neq;
    $supplierId = $request->supplierId;
    $exists = Supplier::where('neq', $neq)
                        ->when($supplierId, function ($query, $supplierId) {
                          return $query->where('id', '!=', $supplierId);
                        })
                      ->exists();
    return response()->json(['exists' => $exists]);
  }
}
