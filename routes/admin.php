<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\GuestController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;

// Admin routes
Route::resource('/admin-area/categories', CategoryController::class);
Route::resource('/admin-area/products', ProductController::class);
Route::resource('/admin-area/guests', GuestController::class);
