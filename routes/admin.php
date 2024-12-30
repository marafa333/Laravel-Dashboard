<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\GuestController;
use App\Http\Controllers\Admin\ProductController;

use Illuminate\Support\Facades\Route;

// Admin routes
Route::group(['prefix' => 'admin-area'], function () {
    Route::resource('', IndexController::class);
    Route::resource('/categories', CategoryController::class);
    Route::resource('/products', ProductController::class);
    Route::resource('/guests', GuestController::class);
});
