<?php
use Illuminate\Support\Facades\Route;
use Modules\Front\Http\Controllers\FrontController;

Route::get('/' , [FrontController::class , 'index'])->name('Front.index');
Route::get('/categories/{}' , [FrontController::class , 'index'])->name('category.show');
Route::get('/course/C-{slug}' , [FrontController::class , 'CourseShow'])->name('course.show');
Route::get('/tutor/{username}' , [FrontController::class , 'TutorShow'])->name('Tutor.show');
