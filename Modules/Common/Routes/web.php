<?php

use Illuminate\Support\Facades\Route;
use Modules\Common\Http\Controllers\CommonController;

Route::get('notification/markAsReed' , [CommonController::class , 'notificationMarkAsReed'])->name('notification.markAsReed');
