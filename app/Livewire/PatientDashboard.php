<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PatientDashboard extends Component
{
    public $appointments;

    protected $listeners = ['refreshAppointments' => '$refresh'];

    public function mount()
    {
        $this->loadAppointments();
    }

    public function loadAppointments()
    {
        $this->appointments = Appointment::where('patient_id', Auth::id())
            ->where('start_time', '>=', Carbon::now())
            ->orderBy('start_time', 'asc')
            ->get();
    }

    public function cancelAppointment($appointmentId)
    {
        $appointment = Appointment::where('id', $appointmentId)
            ->where('patient_id', Auth::id())
            ->first();

        if ($appointment) {
            $appointment->status = 'cancelado';
            $appointment->save();

            $this->loadAppointments();

            session()->flash('message', 'Consulta cancelada com sucesso!');
        }
    }

    public function render()
    {
        return view('livewire.patient-dashboard');
    }
}
