<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuppliersController;
use App\Http\Controllers\UsersController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [UsersController::class, 'showLogin'])->name('login');
Route::post('/login', [UsersController::class,'login'])->name('users.login');
Route::post('/logout', [UsersController::class, 'logout'])->name('users.logout');

//TODO::Ajouter le middleware d'authentification
Route::get('/suppliers', [SuppliersController::class, 'index'])->name('suppliers.index')->middleware('auth');
Route::get('/suppliers/filter', [SuppliersController::class, 'filter'])->name('suppliers.filter');

Route::get('/suppliers/{supplier}', [SuppliersController::class, 'show'])->name('suppliers.show');
