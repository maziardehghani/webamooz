<?php

use Illuminate\Support\Facades\Route;
use Modules\RolePermissions\Http\Controllers\RolePermissionsController;

Route::prefix('dashboard')->middleware(['auth' ])->name('dashboard.')->group(function (){

    Route::get('RolePermissions' , [RolePermissionsController::class , 'index'])->name('Role_permissions');

    Route::post('RolePermissions/store' , [RolePermissionsController::class , 'store'])->name('Role_permissions.store');

    Route::get('RolePermissions/edit/{Role}' , [RolePermissionsController::class , 'edit'])->name('Role_permissions.edit');

    Route::put('RolePermissions/update/{Role}' , [RolePermissionsController::class , 'update'])->name('Role_permissions.update');

    Route::delete('RolePermissions/destroy/{Role}' , [RolePermissionsController::class , 'destroy'])->name('Role_permissions.destroy');

});
