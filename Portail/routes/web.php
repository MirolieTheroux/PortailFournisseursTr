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
Route::post('/logout', [SuppliersController::class, 'logout'])->name('suppliers.logout');

Route::get('/services', [SuppliersController::class, 'search']);
Route::post('suppliers', [SuppliersController::class, 'store'])->name('suppliers.store')->middleware(LoggerMiddleware::class);
Route::get('suppliers/show', [SuppliersController::class, 'show'])->name('suppliers.show');
Route::get('suppliers/home', [SuppliersController::class, 'home'])->name('suppliers.home');

Route::post('/suppliers/checkEmail', [SuppliersController::class, 'checkEmail'])->name('suppliers.checkEmail');
Route::post('/suppliers/checkNeq', [SuppliersController::class, 'checkNeq'])->name('suppliers.checkNeq');

Route::get('/doc', [DocumentationController::class, 'index'])->name('documentation.index');
