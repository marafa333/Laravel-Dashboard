<?php

use App\Http\Controllers\Api\ApiCategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
});
Route::resource('/api/apicate', ApiCategoryController::class);