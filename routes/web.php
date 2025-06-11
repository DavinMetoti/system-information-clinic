<?php

use App\Http\Controllers\Apps\DashboardController;
use App\Http\Controllers\Apps\DoctorManagementController;
use App\Http\Controllers\Apps\SpecializationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('app.dashboard.index')
        : redirect()->route('login');
});
Route::resource('register', RegisterController::class);


Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'index'])->name('login');
    Route::post('login', [LoginController::class, 'store'])->name('login.store');
});

Route::middleware('auth')->get('logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->prefix('app')->name('app.')->group(function () {
    Route::resource('dashboard', DashboardController::class);
});

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('doctor-management', DoctorManagementController::class);
    Route::resource('specialization', SpecializationController::class);
});

Route::middleware(['auth'])->prefix('datatable')->name('datatable.')->group(function () {
    Route::post('doctor', [DoctorManagementController::class, 'datatable'])->name('doctor');
    Route::post('specialization', [SpecializationController::class, 'datatable'])->name('specialization');
});

Route::middleware(['auth'])->prefix('search')->name('search.')->group(function () {
    Route::post('specialization', [SpecializationController::class, 'select'])->name('specialization');
});

