<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.index');
});

Auth::routes();


require_once __DIR__.'/admin.php';