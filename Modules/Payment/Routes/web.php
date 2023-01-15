<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Illuminate\Support\Facades\Route;
use Modules\Payment\Http\Controllers\PaymentController;
use Modules\Payment\Http\Controllers\SattlementController;

Route::any('/payment/callback' , [PaymentController::class , 'callback'])->name('payment.callback');


Route::prefix('dashboard')->name('dashboard.')->group(function (){
    Route::get('/payments' , [PaymentController::class , 'index'])->name('payments');
    Route::get('/myShop/index' , [PaymentController::class , 'myShop'])->name('myShop.index');

    Route::get('/sattlement/index' , [SattlementController::class , 'index'])->name('sattlement.index');
    Route::get('/sattlement/create' , [SattlementController::class , 'create'])->name('sattlement.create');
    Route::post('/sattlement/store/{user}' , [SattlementController::class , 'store'])->name('sattlement.store')->middleware('oneTimeSattleRequest');
    Route::get('/sattlement/edit/{sattlement}' , [SattlementController::class , 'edit'])->name('sattlement.edit');
    Route::put('/sattlement/update/{sattlement}' , [SattlementController::class , 'update'])->name('sattlement.update');
    Route::get('/sattlement/settled/{sattlement}' , [SattlementController::class , 'settled'])->name('sattlement.settled');
    Route::get('/sattlement/rejected/{sattlement}' , [SattlementController::class , 'rejected'])->name('sattlement.rejected');
    Route::get('/sattlement/setTransaction/{sattlement}' , [SattlementController::class , 'setTransaction'])->name('sattlement.setTransaction');

});


