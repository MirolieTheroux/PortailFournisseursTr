<?php

namespace App\Http\Controllers;

use App\Http\Requests\SupplierRequest;
use App\Models\Supplier;
use App\Models\WorkSubcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class SuppliersController extends Controller
{
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
        return View('suppliers.create', compact('workSubcategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SupplierRequest $request)
    {
        $supplier = new Supplier($request->all());
        $supplier->password = Hash::make($request->password);
        $supplier->save();
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
