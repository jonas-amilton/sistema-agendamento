<?php

use Illuminate\Support\Facades\Route;

Route::prefix('paciente')->name('patient.')->group(function () {
    Route::get('login', [\App\Http\Controllers\Patient\Auth\LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [\App\Http\Controllers\Patient\Auth\LoginController::class, 'login']);
    Route::post('logout', [\App\Http\Controllers\Patient\Auth\LoginController::class, 'logout'])->name('logout');

    Route::get('register', [\App\Http\Controllers\Patient\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [\App\Http\Controllers\Patient\Auth\RegisterController::class, 'register']);

    Route::middleware('auth:patients')->group(function () {
        Route::get('dashboard', [App\Http\Controllers\Patient\DashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('appointments', \App\Http\Controllers\Patient\AppointmentController::class);
    });
});
