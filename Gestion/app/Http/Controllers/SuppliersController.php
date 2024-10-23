<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use Illuminate\Support\Facades\Log;

class SuppliersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = Supplier::all();
        $categories = Supplier::with('productsServices.categories')->get();
        Log::info('Catégories:', $categories->toArray());
       

        return View('suppliers.index', compact('suppliers', 'categories'));
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
        $query = Supplier::query();

        if ($request->filled('cities') && is_array($request->input('cities'))) {
            $query->whereHas('address', function($q) use($request){
                $cities = $request->cities; 
                $q->whereIn('city', $cities);
            });
        }

        $suppliers = $query->with('address')->get();
        
        return response()->json([
            'html' => view('suppliers.components.supplierList', compact('suppliers'))->render(),
        ]);
    }
}
