<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuppliersController;
use App\Http\Controllers\DocumentationController;
use App\Http\Controllers\MailsController;
use App\Http\Middleware\LoggerMiddleware;

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', [SuppliersController::class,'showLogin'])->name('suppliers.showLogin');
Route::post('/login', [SuppliersController::class,'login'])->name('suppliers.login');
Route::get('/signin', [SuppliersController::class, 'create'])->name('suppliers.create');
Route::post('/logout', [SuppliersController::class, 'logout'])->name('suppliers.logout');

Route::post('/suppliers/checkEmail', [SuppliersController::class, 'checkEmail'])->name('suppliers.checkEmail');
Route::post('/suppliers/checkNeq', [SuppliersController::class, 'checkNeq'])->name('suppliers.checkNeq');

Route::get('/services', [SuppliersController::class, 'search']);
Route::post('suppliers', [SuppliersController::class, 'store'])->name('suppliers.store')->middleware(LoggerMiddleware::class);
Route::get('suppliers/show', [SuppliersController::class, 'show'])->name('suppliers.show');
Route::get('suppliers/home', [SuppliersController::class, 'home'])->name('suppliers.home');

//Modify suppliers informaiton
Route::post('/suppliers/update/status/{supplier}',[SuppliersController::class, 'updateStatus'])->name('suppliers.updateStatus');
Route::patch('/suppliers/update/identification/{supplier}',[SuppliersController::class, 'updateIdentification'])->name('suppliers.updateIdentification');
Route::post('/suppliers/update/contactDetails/{supplier}',[SuppliersController::class, 'updateContactDetails'])->name('suppliers.updateContactDetails')->middleware(LoggerMiddleware::class);
Route::get('/suppliers/remove/{supplier}', [SuppliersController::class, 'removeFromList'])->name('suppliers.removeFromList');
Route::get('/suppliers/reactivate/{supplier}', [SuppliersController::class, 'reactivate'])->name('suppliers.reactivate');

Route::post('/suppliers/update/contacts/{supplier}',[SuppliersController::class, 'updateContacts'])->name('suppliers.updateContacts');
Route::post('/suppliers/update/rbq/{supplier}',[SuppliersController::class, 'updateRbq'])->name('suppliers.updateRbq');
Route::post('/suppliers/update/productsServices/{supplier}',[SuppliersController::class, 'updateProductsServices'])->name('suppliers.updateProductsServices');
Route::patch('/suppliers/update/finance/{supplier}',[SuppliersController::class, 'updateFinance'])->name('suppliers.updateFinance');


Route::get('/doc', [DocumentationController::class, 'index'])->name('documentation.index');

Route::get('/send-inscription-mail/{supplier}', [MailsController::class, 'sendInscriptionMail']);