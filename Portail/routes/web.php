<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuppliersController;
use App\Http\Controllers\DocumentationController;
use App\Http\Middleware\LoggerMiddleware;

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', [SuppliersController::class,'showLogin'])->name('suppliers.showLogin');
Route::post('/login', [SuppliersController::class,'login'])->name('suppliers.login');
Route::get('/signin', [SuppliersController::class, 'create'])->name('suppliers.create');

Route::post('suppliers', [SuppliersController::class, 'store'])->name('suppliers.store')->middleware(LoggerMiddleware::class);

Route::post('/suppliers/checkEmail', [SuppliersController::class, 'checkEmail'])->name('suppliers.checkEmail');
Route::post('/suppliers/checkNeq', [SuppliersController::class, 'checkNeq'])->name('suppliers.checkNeq');
Route::post('/suppliers/checkRbq', [SuppliersController::class, 'checkRbq'])->name('suppliers.checkRbq');

Route::get('/doc', [DocumentationController::class, 'index'])->name('documentation.index');
