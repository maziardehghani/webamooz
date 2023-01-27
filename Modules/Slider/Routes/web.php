<?php



use Illuminate\Support\Facades\Route;
use Modules\Slider\Http\Controllers\SliderController;

Route::prefix('dashboard')->name('dashboard.')->group(function ()
{
    Route::get('sliders' , [SliderController::class , 'index'])->name('sliders');
    Route::get('slider/create' , [SliderController::class , 'create'])->name('slider.create');
    Route::post('slider/store' , [SliderController::class , 'store'])->name('slider.store');
    Route::get('slider/changeStatus/{status}/{id}' , [SliderController::class , 'changeStatus'])->name('slider.changeStatus');
    Route::get('slider/edit/{slider}' , [SliderController::class , 'edit'])->name('slider.edit');
    Route::put('slider/update/{slider}' , [SliderController::class , 'update'])->name('slider.update');
    Route::get('slider/delete/{slider}' , [SliderController::class , 'delete'])->name('slider.delete');
});
