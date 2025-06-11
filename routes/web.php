<?php

use App\Http\Controllers\Apps\DashboardController;
use App\Http\Controllers\Apps\DoctorManagementController;
use App\Http\Controllers\Apps\MedicalRecordController;
use App\Http\Controllers\Apps\PatientController;
use App\Http\Controllers\Apps\SpecializationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Faker\Provider\Medical;
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
    Route::resource('profile', PatientController::class);
});

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('doctor-management', DoctorManagementController::class);
    Route::resource('specialization', SpecializationController::class);
});

Route::middleware(['auth'])->prefix('doctor')->name('doctor.')->group(function () {
    Route::resource('patient', PatientController::class);
    Route::resource('medical-record', MedicalRecordController::class);
});

Route::middleware(['auth'])->prefix('datatable')->name('datatable.')->group(function () {
    Route::post('doctor', [DoctorManagementController::class, 'datatable'])->name('doctor');
    Route::post('specialization', [SpecializationController::class, 'datatable'])->name('specialization');
    Route::post('patient', [PatientController::class, 'datatable'])->name('patient');
    Route::post('medical-record', [MedicalRecordController::class, 'datatable'])->name('medical-record');
});

Route::middleware(['auth'])->prefix('search')->name('search.')->group(function () {
    Route::post('specialization', [SpecializationController::class, 'select'])->name('specialization');
});

