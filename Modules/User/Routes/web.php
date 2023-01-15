<?php
use Illuminate\Support\Facades\Route;
use Modules\User\Http\Controllers\UserController;
use Modules\User\Actions\verificationCode;
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

Route::post('/email/verify/' , [verificationCode::class , 'verify'])->name('verification.verify')->middleware('auth');



Route::prefix('dashboard')->middleware(['auth'])->name('dashboard.')->group(function (){
    Route::get('users' , [UserController::class , 'index'])->name('users');
    Route::get('users/create' , [UserController::class , 'create'])->name('users.create');
    Route::post('users/store' , [UserController::class , 'store'])->name('users.store');
    Route::get('users/edit/{user}' , [UserController::class , 'edit'])->name('users.edit');
    Route::put('users/update/{user}' , [UserController::class , 'update'])->name('users.update');
    Route::delete('users/destroy/{user}' , [UserController::class , 'destroy'])->name('users.destroy');
    Route::post('users/addPermission/{user}' , [UserController::class , 'addPermission'])->name('users.addPermission');
    Route::get('users/removePermission/{userPermission}/{user}' , [UserController::class , 'removePermission'])->name('users.removePermission');
    Route::patch('users/verifyEmail/{user}' , [UserController::class , 'verifyEmail'])->name('users.verifyEmail');
    Route::post('users/photo' , [UserController::class , 'UpdateUserPhoto'])->name('users.photo');
    Route::get('users/profile' , [UserController::class , 'UserProfile'])->name('users.profile');
    Route::post('users/profile' , [UserController::class , 'UpdateUserProfile'])->name('users.profile.update');
    Route::any('users/logout' , [UserController::class , 'logout'])->name('users.logout');
});
