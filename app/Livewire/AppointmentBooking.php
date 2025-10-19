<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\{
    Specialty,
    Professional,
    Clinic,
    Appointment,
    Patient
};
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class AppointmentBooking extends Component
{
    public $patient;
    public $specialties;
    public $professionals = [];
    public $clinics = [];
    public $availableSlots = [];

    public $specialty_id;
    public $professional_id;
    public $clinic_id;
    public $selected_slot;

    public $step = 1;

    public $patientData = [
        'first_name' => '',
        'last_name' => '',
        'date_of_birth' => '',
        'cpf' => '',
        'phone' => '',
        'email' => '',
        'address' => '',
        'city' => '',
        'insurance_card_number' => '',
    ];

    public function mount()
    {
        $this->specialties = Specialty::all();

        if (Auth::check()) {
            $this->patient = Patient::where('email', Auth::user()->email)->first();
            if ($this->patient) {
                $this->patientData = [
                    'first_name' => $this->patient->first_name,
                    'last_name' => $this->patient->last_name,
                    'date_of_birth' => $this->patient->date_of_birth,
                    'cpf' => $this->patient->cpf,
                    'phone' => $this->patient->phone,
                    'email' => $this->patient->email,
                    'address' => $this->patient->address,
                    'city' => $this->patient->city,
                    'insurance_card_number' => $this->patient->insurance_card_number,
                ];
            }
        }
    }

    public function updatedSpecialtyId($value)
    {
        $this->professionals = Professional::whereHas('specialties', function ($q) use ($value) {
            $q->where('id', $value);
        })->get();

        $this->professional_id = null;
        $this->clinics = [];
        $this->clinic_id = null;
        $this->availableSlots = [];
        $this->selected_slot = null;
    }

    public function updatedProfessionalId($value)
    {
        $this->clinics = Clinic::whereHas('professionals', function ($q) use ($value) {
            $q->where('id', $value);
        })->get();

        $this->clinic_id = null;
        $this->availableSlots = [];
        $this->selected_slot = null;
    }

    public function updatedClinicId($value)
    {
        $this->availableSlots = $this->getAvailableSlots($this->professional_id, $value);
        $this->selected_slot = null;
    }

    protected function getAvailableSlots($professionalId, $clinicId)
    {
        // Aqui você deve implementar a lógica para buscar horários disponíveis
        // Exemplo simples: próximos 5 dias, das 9h às 17h, pulando horários já agendados

        $slots = [];
        $startHour = 9;
        $endHour = 17;
        $durationMinutes = 30; // duração da consulta

        $now = Carbon::now();

        for ($day = 0; $day < 5; $day++) {
            $date = $now->copy()->addDays($day)->startOfDay();

            for ($hour = $startHour; $hour < $endHour; $hour++) {
                $slotStart = $date->copy()->addHours($hour);
                $slotEnd = $slotStart->copy()->addMinutes($durationMinutes);

                // Verifica se já existe agendamento nesse horário para o profissional e clínica
                $exists = Appointment::where('professional_id', $professionalId)
                    ->where('clinic_id', $clinicId)
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

    public function savePatient()
    {
        $this->validate([
            'patientData.first_name' => 'required|string|max:255',
            'patientData.last_name' => 'required|string|max:255',
            'patientData.date_of_birth' => 'required|date',
            'patientData.cpf' => 'required|string|max:20',
            'patientData.phone' => 'required|string|max:20',
            'patientData.email' => 'required|email|max:255',
            'patientData.address' => 'nullable|string|max:255',
            'patientData.city' => 'nullable|string|max:255',
            'patientData.insurance_card_number' => 'nullable|string|max:50',
        ]);

        if ($this->patient) {
            $this->patient->update($this->patientData);
        } else {
            $this->patient = Patient::create($this->patientData);
        }

        $this->step = 2;
    }

    public function bookAppointment()
    {
        $this->validate([
            'specialty_id' => 'required|exists:specialties,id',
            'professional_id' => 'required|exists:professionals,id',
            'clinic_id' => 'required|exists:clinics,id',
            'selected_slot' => 'required|date',
        ]);

        Appointment::create([
            'patient_id' => $this->patient->id,
            'specialty_id' => $this->specialty_id,
            'professional_id' => $this->professional_id,
            'clinic_id' => $this->clinic_id,
            'start_time' => $this->selected_slot,
            'end_time' => Carbon::parse($this->selected_slot)->addMinutes(30),
            'status' => 'agendado',
            'duration_minutes' => 30,
        ]);

        session()->flash('message', 'Consulta agendada com sucesso!');
        $this->reset(['specialty_id', 'professional_id', 'clinic_id', 'selected_slot']);
        $this->step = 1;
    }

    public function render()
    {
        return view('livewire.appointment-booking');
    }
}
