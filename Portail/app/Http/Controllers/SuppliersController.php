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
        
        // Using LOWER() for case-insensitive search and handling whole words
        $services = ProductService::where('code', 'LIKE', "%{$searchTerm}%")
            ->orWhere(function ($query) use ($searchTerm) {
                // Conditions for full word matches
                $query->where('description', 'LIKE', "% {$searchTerm} %")
                      ->orWhere('description', 'LIKE', "{$searchTerm} %")
                      ->orWhere('description', 'LIKE', "% {$searchTerm}")
                      ->orWhere('description', $searchTerm); // Exact match
            })
            ->orWhere(function ($query) use ($searchTerm) {
                // Conditions for partial matches (anywhere in the description)
                $query->where('description', 'LIKE', "%{$searchTerm}%")
                      ->whereNot(function ($subQuery) use ($searchTerm) {
                          // Exclude those that are full word matches
                          $subQuery->where('description', 'LIKE', "% {$searchTerm} %")
                                  ->orWhere('description', 'LIKE', "{$searchTerm} %")
                                  ->orWhere('description', 'LIKE', "% {$searchTerm}")
                                  ->orWhere('description', $searchTerm); // Exact match
                      });
            })
            ->orderByRaw("CASE 
                WHEN description LIKE '{$searchTerm}' THEN 1
                WHEN description LIKE '{$searchTerm} %' THEN 2
                WHEN description LIKE '% {$searchTerm} %' THEN 3
                WHEN description LIKE '% {$searchTerm}' THEN 4
                ELSE 5 
            END")
            ->orderByRaw("POSITION('{$searchTerm}' IN description) ASC")
            ->take(50) // Limit results for performance
            ->get();

        return response()->json($services);
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
