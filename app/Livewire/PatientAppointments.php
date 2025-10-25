<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

class PatientAppointments extends Component
{
    public $appointments = [];

    protected $listeners = ['appointmentCreated' => 'refreshAppointments'];

    public function mount()
    {
        $this->refreshAppointments();
    }

    public function refreshAppointments()
    {
        $this->appointments = Appointment::with('professional')
            ->where('patient_id', Auth::guard('patient')->id())
            ->where('start_time', '>=', now())
            ->orderBy('start_time', 'asc')
            ->get();
    }

    public function render()
    {
        return view('livewire.patient-appointments');
    }
}