<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuppliersController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AttachmentsController;
use App\Http\Controllers\DocumentationController;
use App\Http\Middleware\LoggerMiddleware;
use App\Http\Middleware\CheckRole;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [UsersController::class, 'showLogin'])->name('login');
Route::post('/login', [UsersController::class,'login'])->name('users.login');
Route::post('/logout', [UsersController::class, 'logout'])->name('users.logout')->middleware('auth');

Route::post('/suppliers/checkEmail', [SuppliersController::class, 'checkEmail'])->name('suppliers.checkEmail')->middleware('auth');
Route::post('/suppliers/checkNeq', [SuppliersController::class, 'checkNeq'])->name('suppliers.checkNeq')->middleware('auth');
Route::post('/settings/addUser/checkEmailUser', [UsersController::class, 'checkEmailUser'])->name('users.checkEmailUser')->middleware('CheckRole:admin');
Route::post('/settings/addUser/checkAdmins', [UsersController::class, 'checkNumbersOfAdmin'])->name('users.checkNumbersOfAdmin')->middleware('CheckRole:admin');

Route::get('/suppliers', [SuppliersController::class, 'index'])->name('suppliers.index')->middleware('auth');
Route::post('/suppliers/selectedList', [SuppliersController::class, 'selectedList'])->name('suppliers.selectedList')->middleware('auth');
Route::post('/suppliers/selectedList/export', [SuppliersController::class, 'export'])->name('suppliers.selectedList.export')->middleware('auth');
Route::get('/suppliers/filter', [SuppliersController::class, 'filter'])->name('suppliers.filter')->middleware('auth');
Route::get('/suppliers/waitingSuppliers', [SuppliersController::class, 'waitingSuppliers'])->name('suppliers.waitingSuppliers')->middleware('auth');
Route::get('/services', [SuppliersController::class, 'search'])->middleware('auth');

Route::get('/suppliers/{supplier}', [SuppliersController::class, 'show'])->name('suppliers.show')->middleware('auth');
// MODIFICATION FICHE FOURNISSEUR
Route::post('/suppliers/update/status/{supplier}',[SuppliersController::class, 'updateStatus'])->name('suppliers.updateStatus')->middleware('CheckRole:admin,responsable');
Route::patch('/suppliers/update/identification/{supplier}',[SuppliersController::class, 'updateIdentification'])->name('suppliers.updateIdentification')->middleware('CheckRole:admin,responsable');
Route::post('/suppliers/update/contactDetails/{supplier}',[SuppliersController::class, 'updateContactDetails'])->name('suppliers.updateContactDetails')->middleware('CheckRole:admin,responsable');
Route::get('/suppliers/remove/{supplier}', [SuppliersController::class, 'removeFromList'])->name('suppliers.removeFromList')->middleware('CheckRole:admin,responsable');
Route::get('/suppliers/reactivate/{supplier}', [SuppliersController::class, 'reactivate'])->name('suppliers.reactivate')->middleware('CheckRole:admin,responsable');
Route::get('/suppliers/approve/{supplier}', [SuppliersController::class, 'approveRequest'])->name('suppliers.approveRequest')->middleware('CheckRole:admin,responsable');
Route::post('/suppliers/deny/{supplier}', [SuppliersController::class, 'denyRequest'])->name('suppliers.denyRequest')->middleware('CheckRole:admin,responsable');
Route::post('/suppliers/update/contacts/{supplier}',[SuppliersController::class, 'updateContacts'])->name('suppliers.updateContacts')->middleware('CheckRole:admin,responsable');
Route::post('/suppliers/update/rbq/{supplier}',[SuppliersController::class, 'updateRbq'])->name('suppliers.updateRbq')->middleware('CheckRole:admin,responsable');
Route::post('/suppliers/update/productsServices/{supplier}',[SuppliersController::class, 'updateProductsServices'])->name('suppliers.updateProductsServices')->middleware('CheckRole:admin,responsable');
Route::post('/suppliers/update/attachments/{supplier}',[SuppliersController::class, 'updateAttachments'])->name('suppliers.updateAttachments')->middleware('CheckRole:admin,responsable');
Route::patch('/suppliers/update/finance/{supplier}',[SuppliersController::class, 'updateFinance'])->name('suppliers.updateFinance')->middleware('CheckRole:admin,responsable');

Route::get('/attachment/{supplier}/{attachment}', [AttachmentsController::class, 'show'])->name('attachments.show')->middleware('auth');

// SETTINGS USERS
Route::get('/settings', [UsersController::class, 'show'])->name('users.settings')->middleware('CheckRole:admin');
Route::patch('/settings/updateUser', [UsersController::class, 'updateUser'])->name('users.updateUser')->middleware('CheckRole:admin');
// SETTINGS

Route::get('/doc', [DocumentationController::class, 'index'])->name('documentation.index');
