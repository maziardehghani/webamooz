<?php

use Illuminate\Support\Facades\Route;
use Modules\Front\Http\Controllers\FrontController;

Route::any('/' , [FrontController::class , 'index'])->name('Front.index');
Route::any('/search' , [FrontController::class , 'search'])->name('Front.search');
Route::get('/categories/{category}' , [FrontController::class , 'categories'])->name('category.show');
Route::get('/courses/C-{slug}' , [FrontController::class , 'CourseShow'])->name('courses.show');
Route::get('/tutor/{username}' , [FrontController::class , 'TutorShow'])->name('Tutor.show');
Route::get('/discounterPage/{course}' , [FrontController::class , 'discounterPage'])->name('discounterPage.show');
Route::post('courses/discount/{course}' , [FrontController::class , 'discount'])->name('Front.discount')->middleware('throttle:6,1');
Route::get('all_courses' , [FrontController::class , 'all_courses'])->name('all_courses');
