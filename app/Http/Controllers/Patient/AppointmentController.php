<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Professional;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with('professional')
            ->where('patient_id', Auth::guard('patients')->id())
            ->orderBy('start_time', 'desc')
            ->get();

        return Inertia::render('Patient/Appointments/Index', [
            'appointments' => $appointments,
        ]);
    }

    public function create()
    {
        return Inertia::render('Patient/Appointments/Create', [
            'professionals' => Professional::all(['id', 'first_name', 'last_name']),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'professional_id' => 'required|exists:professionals,id',
            'start_time'      => 'required|date|after:now',
        ]);

        Appointment::create([
            'patient_id'      => Auth::guard('patients')->id(),
            'professional_id' => $data['professional_id'],
            'clinic_id'       => Auth::guard('patients')->user()->clinic_id,
            'start_time'      => $data['start_time'],
            'status'          => 'scheduled',
            'duration_minutes' => 30,
        ]);

        return redirect()->route('patient.appointments.index');
    }

    public function edit(Appointment $appointment)
    {
        $this->authorizePatient($appointment);

        return Inertia::render('Patient/Appointments/Edit', [
            'appointment' => $appointment,
            'professionals' => Professional::all(['id', 'first_name', 'last_name']),
        ]);
    }

    public function update(Request $request, Appointment $appointment)
    {
        $this->authorizePatient($appointment);

        $data = $request->validate([
            'start_time' => 'required|date|after:now',
        ]);

        $appointment->update($data);

        return redirect()->route('patient.appointments.index');
    }

    public function destroy(Appointment $appointment)
    {
        $this->authorizePatient($appointment);

        $appointment->update(['status' => 'cancelled']);

        return redirect()->route('patient.appointments.index');
    }

    private function authorizePatient(Appointment $appointment)
    {
        if ($appointment->patient_id !== Auth::guard('patients')->id()) {
            abort(403, 'Acesso negado.');
        }
    }
}
