<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DishController;
use App\Http\Controllers\Admin\HomeController as Admin;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function () {
    Route::get('', function () { return view('dashboard'); })->name('index');
});

Route::prefix('admin')->name('admin.')->middleware(['auth', 'can:admin'])->group(function () {
    Route::get('', Admin::class)->name('home');
    Route::resource('users', UserController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('dishes', DishController::class);
    Route::resource('menus', MenuController::class);
});

require __DIR__.'/auth.php';
