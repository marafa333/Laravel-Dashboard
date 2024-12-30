<?php


use App\Http\Controllers\Web\WebPageController;
use Illuminate\Support\Facades\Route;

Route::get('/admin-area', function () {
    return view('admin.index');
})->name('admin')->middleware('auth');

Route::get('/',function (){
    return view('web.index');
})->name('web');

Route::get('/', [WebPageController::class, 'index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

require_once __DIR__ . '/admin.php';
require_once __DIR__ . '/api.php';