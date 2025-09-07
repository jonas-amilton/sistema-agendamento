<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Patient\Auth\LoginController;
use App\Http\Controllers\Patient\Auth\RegisterController;
use App\Http\Controllers\Patient\DashboardController;
use App\Http\Controllers\Patient\AppointmentController;

Route::prefix('paciente')->name('patient.')->group(function () {

    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login'])->name('login.post');

    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register'])->name('register.post');

    Route::middleware('auth.patient')->group(function () {
        Route::post('logout', [LoginController::class, 'logout'])->name('logout');

        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('appointments', AppointmentController::class);
    });
});
