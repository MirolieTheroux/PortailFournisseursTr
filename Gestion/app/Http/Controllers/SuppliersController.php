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
   
    return view('suppliers.index', compact('suppliers'));
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
    return View('suppliers.show', compact('supplier', 'suppliersGroupedByNatureAndCategory'));
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
