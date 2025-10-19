<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\{
    Appointment,
    Professional,
    Specialty
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function index()
    {
        $specialties = Specialty::all();
        $professionals = Professional::all();

        return view('patient.appointment', compact('specialties', 'professionals'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function edit(Appointment $appointment)
    {
        //
    }

    public function update(Request $request, Appointment $appointment)
    {
        //
    }

    public function destroy(Appointment $appointment)
    {
        //
    }
}
