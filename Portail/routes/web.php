<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuppliersController;
use App\Http\Controllers\AttachmentsController;
use App\Http\Controllers\DocumentationController;
use App\Http\Controllers\MailsController;
use App\Http\Middleware\LoggerMiddleware;

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', [SuppliersController::class,'home'])->name('suppliers.home');
Route::get('/login', [SuppliersController::class,'showLogin'])->name('suppliers.showLogin');
Route::post('/login', [SuppliersController::class,'login'])->name('suppliers.login');
Route::get('/signin', [SuppliersController::class, 'create'])->name('suppliers.create');
Route::post('/logout', [SuppliersController::class, 'logout'])->name('suppliers.logout')->middleware('auth');

Route::post('/suppliers/checkEmail', [SuppliersController::class, 'checkEmail'])->name('suppliers.checkEmail');
Route::post('/suppliers/checkNeq', [SuppliersController::class, 'checkNeq'])->name('suppliers.checkNeq');

Route::get('/services', [SuppliersController::class, 'search']);
Route::post('suppliers', [SuppliersController::class, 'store'])->name('suppliers.store')->middleware(LoggerMiddleware::class);
Route::get('suppliers/show', [SuppliersController::class, 'show'])->name('suppliers.show')->middleware('auth');
Route::get('suppliers/home', [SuppliersController::class, 'home'])->name('suppliers.home');

//Modify suppliers informaiton
Route::patch('/suppliers/update/identification/{supplier}',[SuppliersController::class, 'updateIdentification'])->name('suppliers.updateIdentification')->middleware('auth');
Route::post('/suppliers/update/contactDetails/{supplier}',[SuppliersController::class, 'updateContactDetails'])->name('suppliers.updateContactDetails')->middleware('auth')->middleware(LoggerMiddleware::class);
Route::get('/suppliers/remove/{supplier}', [SuppliersController::class, 'removeFromList'])->name('suppliers.removeFromList')->middleware('auth');
Route::get('/suppliers/reactivate/{supplier}', [SuppliersController::class, 'reactivate'])->name('suppliers.reactivate')->middleware('auth');

Route::post('/suppliers/update/contacts/{supplier}',[SuppliersController::class, 'updateContacts'])->name('suppliers.updateContacts')->middleware('auth');
Route::post('/suppliers/update/rbq/{supplier}',[SuppliersController::class, 'updateRbq'])->name('suppliers.updateRbq')->middleware('auth');
Route::post('/suppliers/update/productsServices/{supplier}',[SuppliersController::class, 'updateProductsServices'])->name('suppliers.updateProductsServices')->middleware('auth');
Route::post('/suppliers/update/attachments/{supplier}',[SuppliersController::class, 'updateAttachments'])->name('suppliers.updateAttachments')->middleware('auth');
Route::patch('/suppliers/update/finance/{supplier}',[SuppliersController::class, 'updateFinance'])->name('suppliers.updateFinance')->middleware('auth');

Route::get('/attachment/{supplier}/{attachment}', [AttachmentsController::class, 'show'])->name('attachments.show')->middleware('auth');

Route::get('/doc', [DocumentationController::class, 'index'])->name('documentation.index');

Route::post('/password/forgot', [SuppliersController::class, 'forgotPassword']);
Route::get('/password/reset/{token}', [SuppliersController::class, 'resetPasswordForm'])->name('password.reset');
Route::post('/password/reset', [SuppliersController::class, 'resetPassword']);