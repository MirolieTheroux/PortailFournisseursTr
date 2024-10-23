<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\WorkSubcategory;
use Illuminate\Support\Facades\Log;

class SuppliersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = Supplier::all();
        $workSubcategories = WorkSubcategory::all();
        return View('suppliers.index', compact('suppliers', 'workSubcategories'));
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
        return View('suppliers.show', compact('supplier'));
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

    public function filter(Request $request)
    {
        Log::debug($request);
        $query = Supplier::query();

        if ($request->filled('cities') && is_array($request->input('cities'))) {
            $query->whereHas('address', function($q) use($request){
                $cities = $request->cities; 
                $q->whereIn('city', $cities);
            });
        }

        if ($request->filled('districtAreas') && is_array($request->input('districtAreas'))) {
            $query->whereHas('address', function($q) use($request){
                $districtAreas = $request->districtAreas; 
                $q->whereIn('region', $districtAreas);
            });
        }

        if ($request->filled('workCategories') && is_array($request->input('workCategories'))) {
            $query->whereHas('workSubcategories', function($q) use($request){
                $workCategories = $request->workCategories; 
                $q->whereIn('code', $workCategories);
            });
        }

        $suppliers = $query->with('address')->get();
        
        return response()->json([
            'html' => view('suppliers.components.supplierList', compact('suppliers'))->render(),
        ]);
    }
}
