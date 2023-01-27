<?php

use Illuminate\Support\Facades\Route;
use Modules\Comment\Http\Controllers\CommentController;

Route::post('/comment/store' ,[CommentController::class , 'store' ])->middleware('auth' , 'verified')->name('comment.store');

Route::prefix('dashboard')->name('dashboard.')->group(function ()
{
    Route::get('/comments' , [CommentController::class , 'index'])->name('comments');
    Route::get('/comments/delete/{comment}' , [CommentController::class , 'delete'])->name('comments.delete');
    Route::get('/comments/reject/{comment}' , [CommentController::class , 'reject'])->name('comments.reject');
    Route::get('/comments/answers/{comment}' , [CommentController::class , 'answers'])->name('comments.answers');
    Route::get('/comments/accept/{comment}' , [CommentController::class , 'accept'])->name('comments.accept');
});
