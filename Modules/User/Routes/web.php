<?php
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('user::home.index');
})->name('home');


Route::get('logout_test' , function ()
{
    auth()->logout();
});

Route::post('/email/verify/' , [verificationCode::class , 'verify'])->name('verification.verify')->middleware('auth');
