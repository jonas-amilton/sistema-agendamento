<?php

namespace App\Http\Controllers\Patient;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Patient;

class DashboardController extends Controller
{
    public function index()
    {
        $patient = Auth::guard('patients')->user();

        $patient = Patient::with([
            'appointments.professional',
            'clinic.professionals',
        ])->find(Auth::guard('patients')->id());


        //
    }
}
