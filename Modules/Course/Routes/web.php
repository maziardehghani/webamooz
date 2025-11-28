<?php

use Illuminate\Support\Facades\Route;
use Modules\Course\Http\Controllers\CourseController;
use Modules\Course\Http\Controllers\lessonController;
use Modules\Course\Http\Controllers\SeasonController;

Route::prefix('dashboard')->name('dashboard.')->group(function (){

    //courses routes
    Route::get('courses' , [CourseController::class , 'index'])->name('courses');
    Route::get('courses/create' , [CourseController::class , 'create'])->name('courses.create');
    Route::post('courses/store' , [CourseController::class , 'store'])->name('courses.store');
    Route::get('courses/edit/{courses}' , [CourseController::class , 'edit'])->name('courses.edit');
    Route::put('courses/update/{courses}' , [CourseController::class , 'update'])->name('courses.update');
    Route::delete('courses/destroy/{courses}' , [CourseController::class , 'destroy'])->name('courses.destroy');
    Route::patch('courses/{courses}/accept' , [CourseController::class , 'accept'])->name('courses.accept');
    Route::patch('courses/{courses}/reject' , [CourseController::class , 'reject'])->name('courses.reject');
    Route::patch('courses/{courses}/locked' , [CourseController::class , 'lock'])->name('courses.locked');
    Route::get('courses/details/{courses}' , [CourseController::class , 'details'])->name('courses.details');
    Route::post('courses/buy/{courses}' , [CourseController::class , 'buy'])->name('courses.buy');

    ///season routes
    Route::post('seasons/store/{courses}' , [SeasonController::class , 'store'])->name('seasons.store');
    Route::get('seasons/edit/{season}' , [SeasonController::class , 'edit'])->name('seasons.edit');
    Route::put('seasons/update/{season}' , [SeasonController::class , 'update'])->name('seasons.update');
    Route::get('seasons/destroy/{season}' , [SeasonController::class , 'destroy'])->name('seasons.destroy');
    Route::patch('seasons/{season}/accept' , [SeasonController::class , 'accept'])->name('seasons.accept');
    Route::patch('seasons/{season}/reject' , [SeasonController::class , 'reject'])->name('seasons.reject');
    ///lessonController routes
    Route::get('courses/lessons/create/{courses}' , [lessonController::class , 'create'])->name('lessons.create');
    Route::post('courses/lessons/store/{courses}' , [lessonController::class , 'store'])->name('lessons.store');
    Route::get('courses/lessons/edit/{lesson}/{courses}' , [lessonController::class , 'edit'])->name('lessons.edit');
    Route::put('courses/lessons/update/{lesson}/{courses}' , [lessonController::class , 'update'])->name('lessons.update');
    Route::delete('courses/{courses}/lessons/{lesson}/destroy' , [lessonController::class , 'destroy'])->name('lessons.destroy');
});
