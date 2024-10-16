<?php

namespace App\Http\Controllers;

use App\Http\Requests\SupplierRequest;
use App\Models\Supplier;
use App\Models\WorkSubcategory;
use App\Models\Province;
use App\Models\ProductService;
use App\Models\ProductServiceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class SuppliersController extends Controller
{
    public function validateNeq(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'neq' => 'required|string|size:10'  // Ensure NEQ is a 10-character string
        ]);

        $neq = $request->input('neq');

        // Query the database for the NEQ
        $exists = DB::table('suppliers')->where('neq', $neq)->exists();

        // Return JSON response
        return response()->json(['exists' => $exists]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $workSubcategories = WorkSubcategory::orderByRaw('
          CAST(SUBSTRING_INDEX(code, ".", 1) AS UNSIGNED), 
          CAST(SUBSTRING_INDEX(SUBSTRING_INDEX(CONCAT(code, ".0"), ".", 2), ".", -1) AS UNSIGNED), 
          CAST(SUBSTRING_INDEX(CONCAT(code, ".0.0"), ".", -1) AS UNSIGNED)
        ')->get();
        $provinces = Province::all();
        $productServices = ProductService::all();
        $productServiceSubCategories = ProductServiceCategory::all();
        $productServiceCategories = ProductServiceCategory::select('nature')->groupBy('nature')->orderBy('nature')->get();

        return View('suppliers.create', compact('workSubcategories','provinces', 'productServices', 'productServiceSubCategories', 'productServiceCategories'));
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





    /**
     * Store a newly created resource in storage.
     */
    public function store(SupplierRequest $request)
    {
        $supplier = new Supplier($request->all());
        $supplier->password = Hash::make($request->password);

        //$supplier->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

}
