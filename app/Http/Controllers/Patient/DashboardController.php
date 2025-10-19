<?php

namespace App\Http\Controllers\Patient;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Appointment;

class DashboardController extends Controller
{
    public function index()
    {
        $appointments = Appointment::where('patient_id', Auth::guard('patient')->id())
            ->orderBy('start_time', 'asc')
            ->get();

        return view('patient.dashboard', compact('appointments'));
    }
}
