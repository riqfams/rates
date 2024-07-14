<?php

Route::middleware('auth')->prefix('resources')->name('resources.')->group(function () {
    Route::resource('users', App\Http\Controllers\Resources\UserController::class);
    Route::resource('permissions', App\Http\Controllers\Resources\PermissionController::class);
    Route::resource('roles', App\Http\Controllers\Resources\RoleController::class);

    Route::prefix('setting')->name('setting.')->group(function () {
        Route::get('general',[App\Http\Controllers\Resources\SettingController::class,'general'])->name('general.index');
        Route::post('general',[App\Http\Controllers\Resources\SettingController::class,'update_general'])->name('general.update');
    
        Route::get('smtp',[App\Http\Controllers\Resources\SettingController::class,'smtp'])->name('smtp.index');
        Route::post('smtp/update',[App\Http\Controllers\Resources\SettingController::class,'update_smtp'])->name('smtp.update');
        
        Route::resource('config', App\Http\Controllers\Resources\ConfigController::class);
        // Route::resource('language', App\Http\Controllers\Resources\LanguageController::class);

    });

});
