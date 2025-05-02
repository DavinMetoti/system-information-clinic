<?php

use App\Http\Controllers\Apps\CategoryController;
use App\Http\Controllers\Apps\DashboardController;
use App\Http\Controllers\Apps\SupplierController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

// Root route: arahkan sesuai status login
Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('app.dashboard.index')
        : redirect()->route('login');
});

Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'index'])->name('login');
    Route::post('login', [LoginController::class, 'store'])->name('login.store');
});

Route::middleware('auth')->get('logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->prefix('app')->name('app.')->group(function () {
    Route::resource('dashboard', DashboardController::class);
    Route::resource('suppliers', SupplierController::class);
    Route::resource('categories', CategoryController::class);
    Route::post('/suppliers/datatable', [SupplierController::class, 'datatable'])->name('suppliers.datatable');
    Route::post('/categories/datatable', [CategoryController::class, 'datatable'])->name('categories.datatable');
});

Route::middleware(['auth'])->prefix('user-management')->name('user-management.')->group(function () {
    Route::resource('users', RegisterController::class);
    Route::post('/users/datatable', [RegisterController::class, 'datatable'])->name('users.datatable');
});
