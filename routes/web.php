<?php

use App\Livewire\AppointmentBooking;
use Illuminate\Support\Facades\Route;
use App\Livewire\{
    PatientLogin,
    PatientRegister,
    PatientDashboard,
    PatientAppointment
};

Route::get('/', function () {
    return redirect('agendar');
});

Route::get('/agendar', AppointmentBooking::class)->name('appointment.booking');


Route::get('/login', PatientLogin::class)->name('patient.login');
Route::get('/register', PatientRegister::class)->name('patient.register');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', PatientDashboard::class)->name('patient.dashboard');
    Route::get('/agendar', PatientAppointment::class)->name('patient.appointment');
});