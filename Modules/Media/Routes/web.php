<?php

use Illuminate\Support\Facades\Route;
use Modules\Media\Http\Controllers\MediaController;

Route::get('media/{media}/download' , [MediaController::class , 'download'])->name('media.download');
