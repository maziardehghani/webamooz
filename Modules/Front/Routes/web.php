<?php

use Illuminate\Support\Facades\Route;
use Modules\Front\Http\Controllers\FrontController;

Route::get('/' , [FrontController::class , 'index'])->name('Front.index');
Route::get('/categories/{}' , [FrontController::class , 'index'])->name('category.show');
Route::get('/course/C-{slug}' , [FrontController::class , 'CourseShow'])->name('course.show');
Route::get('/tutor/{username}' , [FrontController::class , 'TutorShow'])->name('Tutor.show');
Route::get('/discounterPage/{course}' , [FrontController::class , 'discounterPage'])->name('discounterPage.show');
Route::post('course/discount/{course}' , [FrontController::class , 'discount'])->name('Front.discount')->middleware('throttle:6,1');
Route::get('all_courses' , [FrontController::class , 'all_courses'])->name('all_courses');
