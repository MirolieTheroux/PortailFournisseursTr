<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuppliersController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [SuppliersController::class, 'index'])->name('suppliers.index');
