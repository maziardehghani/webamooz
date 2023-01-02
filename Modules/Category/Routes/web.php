<?php

use Illuminate\Support\Facades\Route;
use Modules\Category\Http\Controllers\CategoriesController;

Route::prefix('dashboard')->middleware(['auth'])->name('dashboard.')->group(function (){

    Route::get('categories' , [CategoriesController::class , 'index'])->name('categories');

    Route::post('categories/store' , [CategoriesController::class , 'store'])->name('categories.store');

    Route::get('categories/edit/{category}' , [CategoriesController::class , 'edit'])->name('categories.edit');

    Route::put('categories/update/{category}' , [CategoriesController::class , 'update'])->name('categories.update');

    Route::delete('categories/destroy/{category}' , [CategoriesController::class , 'destroy'])->name('categories.destroy');

});
