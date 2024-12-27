<?php


use Illuminate\Support\Facades\Route;

Route::get('/admin-area', function () {
    return view('admin.index',  ['user' => Auth::user()]);
})->name('admin')->middleware('auth');

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

require_once __DIR__ . '/admin.php';
require_once __DIR__ . '/api.php';