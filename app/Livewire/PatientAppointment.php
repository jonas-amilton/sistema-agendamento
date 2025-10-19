<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Specialty;
use App\Models\Professional;
use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PatientAppointment extends Component
{
    public $specialties;
    public $professionals = [];
    public $availableSlots = [];

    public $specialty_id = null;
    public $professional_id = null;
    public $selected_slot = null;

    public $step = 1;

    public function mount()
    {
        $this->specialties = Specialty::all();
        $this->professionals = Professional::all();

        if ($this->professionals->isNotEmpty()) {
            $this->availableSlots = $this->getAvailableSlots($this->professionals->first()->id);
            $this->professional_id = $this->professionals->first()->id;
        }
    }

    public function updatedSpecialtyId($value)
    {
        $this->professionals = Professional::whereHas('specialties', function ($q) use ($value) {
            $q->where('specialties.id', $value);
        })->get();

        $this->professional_id = null;
        $this->availableSlots = [];
        $this->selected_slot = null;
    }

    public function updatedProfessionalId($value)
    {
        $this->availableSlots = $this->getAvailableSlots($value);
        $this->selected_slot = null;
    }

    protected function getAvailableSlots($professionalId)
    {
        $slots = [];
        $startHour = 9;
        $endHour = 17;
        $durationMinutes = 30;

        $now = Carbon::now();

        for ($day = 0; $day < 7; $day++) {
            $date = $now->copy()->addDays($day)->startOfDay();

            for ($hour = $startHour; $hour < $endHour; $hour++) {
                $slotStart = $date->copy()->addHours($hour);
                $slotEnd = $slotStart->copy()->addMinutes($durationMinutes);

                $exists = Appointment::where('professional_id', $professionalId)
                    ->where(function ($query) use ($slotStart, $slotEnd) {
                        $query->whereBetween('start_time', [$slotStart, $slotEnd])
                            ->orWhereBetween('end_time', [$slotStart, $slotEnd]);
                    })
                    ->exists();

                if (!$exists && $slotStart->isFuture()) {
                    $slots[] = $slotStart->format('Y-m-d H:i:s');
                }
            }
        }

        return $slots;
    }

    public function book()
    {
        if (!Auth::guard('patients')->check()) {
            return redirect()->route('patient.login');
        }

        $this->validate([
            'specialty_id' => 'required|exists:specialties,id',
            'professional_id' => 'required|exists:professionals,id',
            'selected_slot' => 'required|date',
        ]);

        $professional = Professional::find($this->professional_id);
        $clinicId = $professional ? $professional->clinic_id : null;

        Appointment::create([
            'patient_id' => Auth::user()->id,
            'specialty_id' => $this->specialty_id,
            'professional_id' => $this->professional_id,
            'clinic_id' => $clinicId,
            'start_time' => $this->selected_slot,
            'end_time' => Carbon::parse($this->selected_slot)->addMinutes(30),
            'status' => 'scheduled',
            'duration_minutes' => 30,
        ]);

        session()->flash('message', 'Consulta agendada com sucesso!');
        $this->reset(['specialty_id', 'professional_id', 'selected_slot', 'professionals', 'availableSlots']);
        $this->step = 1;
    }

    public function render()
    {
        return view('livewire.patient-appointment');
    }
}
