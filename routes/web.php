<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DishController;
use App\Http\Controllers\Admin\HomeController as Admin;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Dashboard\TelegramController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function () {
    Route::get('', function () { return view('dashboard'); })->name('home');
});

Route::prefix('telegram')->name('telegram.')->middleware(['auth'])->group(function () {
    Route::post('link', [TelegramController::class, 'link'])->name('link');
    Route::delete('unlink/{user}', [TelegramController::class, 'unlink'])->name('unlink');
    Route::get('token', [TelegramController::class, 'token'])
        ->withoutMiddleware(['auth'])
        ->middleware(['throttle'])
        ->name('token');
});

Route::prefix('admin')->name('admin.')->middleware(['auth', 'can:admin'])->group(function () {
    Route::get('', Admin::class)->name('home');
    Route::resource('users', UserController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('dishes', DishController::class);
    Route::resource('menus', MenuController::class);
});

require __DIR__.'/auth.php';
