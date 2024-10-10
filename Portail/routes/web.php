<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuppliersController;
use App\Http\Middleware\LoggerMiddleware;

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', [SuppliersController::class, 'create'])->name('suppliers.create');

Route::post('suppliers', [SuppliersController::class, 'store'])->name('suppliers.store');

Route::post('/suppliers/checkEmail', [SuppliersController::class, 'checkEmail'])->name('suppliers.checkEmail');
Route::post('/suppliers/checkNeq', [SuppliersController::class, 'checkNeq'])->name('suppliers.checkNeq');
Route::post('/suppliers/checkRbq', [SuppliersController::class, 'checkRbq'])->name('suppliers.checkRbq');