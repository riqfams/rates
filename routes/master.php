<?php

Route::middleware('auth')->prefix("master")->name("master.")->group(function () {

    Route::resource('category',App\Http\Controllers\Master\CategoryController::class);
});
