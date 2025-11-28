<?php

use Illuminate\Support\Facades\Route;
use Modules\Discount\Http\Controllers\DiscountController;

Route::prefix('dashboard')->name('dashboard.')->group(function ()
{
    Route::get('discount/index' , [DiscountController::class , 'index'])->name('discounts');
    Route::post('discount/store' , [DiscountController::class , 'store'])->name('discounts.store');
    Route::get('discount/delete/{discount}' , [DiscountController::class , 'delete'])->name('discounts.delete');
});
