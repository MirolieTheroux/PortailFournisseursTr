<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuppliersController;

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', [SuppliersController::class, 'create'])->name('suppliers.create');

Route::post('suppliers', [SuppliersController::class, 'store'])->name('suppliers.store');