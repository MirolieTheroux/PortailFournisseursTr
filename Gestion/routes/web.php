<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuppliersController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AttachmentsController;
use App\Http\Middleware\LoggerMiddleware;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [UsersController::class, 'showLogin'])->name('login');
Route::post('/login', [UsersController::class,'login'])->name('users.login');
Route::post('/logout', [UsersController::class, 'logout'])->name('users.logout');

Route::post('/suppliers/checkEmail', [SuppliersController::class, 'checkEmail'])->name('suppliers.checkEmail');
Route::post('/suppliers/checkNeq', [SuppliersController::class, 'checkNeq'])->name('suppliers.checkNeq');

//TODO::Ajouter le middleware d'authentification
Route::get('/suppliers', [SuppliersController::class, 'index'])->name('suppliers.index')->middleware('auth');
Route::post('/suppliers/selectedList', [SuppliersController::class, 'selectedList'])->name('suppliers.selectedList')->middleware('auth');
Route::post('/suppliers/selectedList/export', [SuppliersController::class, 'export'])->name('suppliers.selectedList.export')->middleware('auth');
Route::get('/suppliers/filter', [SuppliersController::class, 'filter'])->name('suppliers.filter');
Route::get('/suppliers/waitingSuppliers', [SuppliersController::class, 'waitingSuppliers'])->name('suppliers.waitingSuppliers');
Route::get('/services', [SuppliersController::class, 'search']);

Route::get('/suppliers/{supplier}', [SuppliersController::class, 'show'])->name('suppliers.show');
// MODIFICATION FICHE FOURNISSEUR
Route::post('/suppliers/update/status/{supplier}',[SuppliersController::class, 'updateStatus'])->name('suppliers.updateStatus')->middleware(LoggerMiddleware::class);
Route::patch('/suppliers/update/identification/{supplier}',[SuppliersController::class, 'updateIdentification'])->name('suppliers.updateIdentification')->middleware(LoggerMiddleware::class);
Route::post('/suppliers/update/contactDetails/{supplier}',[SuppliersController::class, 'updateContactDetails'])->name('suppliers.updateContactDetails')->middleware(LoggerMiddleware::class);
Route::get('/suppliers/remove/{supplier}', [SuppliersController::class, 'removeFromList'])->name('suppliers.removeFromList');
Route::get('/suppliers/reactivate/{supplier}', [SuppliersController::class, 'reactivate'])->name('suppliers.reactivate');
Route::get('/suppliers/approve/{supplier}', [SuppliersController::class, 'approveRequest'])->name('suppliers.approveRequest');
Route::post('/suppliers/deny/{supplier}', [SuppliersController::class, 'denyRequest'])->name('suppliers.denyRequest');

Route::post('/suppliers/update/contacts/{supplier}',[SuppliersController::class, 'updateContacts'])->name('suppliers.updateContacts');
Route::post('/suppliers/update/rbq/{supplier}',[SuppliersController::class, 'updateRbq'])->name('suppliers.updateRbq');


Route::get('/attachment/{supplier}/{attachment}', [AttachmentsController::class, 'show'])->name('attachments.show');

