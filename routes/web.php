<?php

use App\Http\Controllers\App\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'index'])->name('login.index');
    Route::post('login', [LoginController::class, 'store'])->name('login.store');
    Route::get('login', [LoginController::class, 'index'])->name('login');
});

Route::get('/', function () {
    return redirect()->route('login.index');
});

Route::middleware(['auth'])->prefix('app')->name('app.')->group(function () {
    Route::resource('dashboard', DashboardController::class);
});

// User management routes
Route::middleware(['auth'])->prefix('user-management')->name('user-management.')->group(function () {
    Route::resource('users', RegisterController::class);
    Route::post('/users/datatable', [RegisterController::class, 'datatable'])->name('users.datatable');
});
