<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\{
    Specialty,
    Professional,
    Appointment
};
use Illuminate\Support\Facades\Auth;

class AppointmentForm extends Component
{
    public $specialties;
    public $specialty_id;
    public $professionals = [];
    public $professional_id;
    public $start_time;
    public $availableSlots = [];
    public $selectedDate = null;
    public $successMessage = null;
    public $showModal = false;

    public function mount()
    {
        $this->specialties = Specialty::all();
        $this->professionals = [];
    }

    public function updatedSpecialtyId($value)
    {
        $this->professionals = Professional::whereHas('specialties', function ($query) use ($value) {
            $query->where('specialty_id', $value);
        })->get();

        $this->professional_id = null;
    }

    public function updatedProfessionalId($value)
    {
        $this->selectedDate = null;
        $this->generateAvailableSlots($value);
    }

    public function updatedSelectedDate($date)
    {
        $this->generateAvailableSlots($this->professional_id, $date);
    }

    private function generateAvailableSlots($professionalId, $date = null)
    {
        if (!$professionalId || !$date) return;

        $dateCarbon = \Carbon\Carbon::parse($date);
        $startOfDay = $dateCarbon->copy()->setHour(8)->setMinute(0)->setSecond(0);
        $endOfDay = $dateCarbon->copy()->setHour(18)->setMinute(0)->setSecond(0);

        $appointments = Appointment::where('professional_id', $professionalId)
            ->where('status', 'scheduled')
            ->whereDate('start_time', $dateCarbon->toDateString())
            ->get();

        $slots = [];

        while ($startOfDay->lt($endOfDay)) {
            $slotEnd = $startOfDay->copy()->addMinutes(30);

            // Ignora horário de almoço (12:00 - 13:00)
            if ($startOfDay->hour >= 12 && $startOfDay->hour < 13) {
                $startOfDay->addMinutes(30);
                continue;
            }

            // Verifica conflito com agendamentos existentes
            $conflict = $appointments->first(function ($a) use ($startOfDay, $slotEnd) {
                $appointmentStart = \Carbon\Carbon::parse($a->start_time);
                $appointmentEnd = $appointmentStart->copy()->addMinutes($a->duration_minutes);
                return $slotEnd->gt($appointmentStart) && $startOfDay->lt($appointmentEnd);
            });

            if (!$conflict) {
                $slots[] = $startOfDay->format('Y-m-d H:i');
            }

            $startOfDay->addMinutes(30);
        }

        $this->availableSlots = $slots;
    }

    public function openModal()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function submit()
    {
        $this->validate([
            'specialty_id' => 'required|exists:specialties,id',
            'professional_id' => 'required|exists:professionals,id',
            'start_time' => 'required|date',
        ]);

        $professional = Professional::find($this->professional_id);

        $startTime = \Carbon\Carbon::parse($this->start_time);
        $endTime = $startTime->copy()->addMinutes(30);

        Appointment::create([
            'patient_id' => Auth::guard('patient')->id(),
            'professional_id' => $this->professional_id,
            'start_time' => $this->start_time,
            'status' => 'scheduled',
            'clinic_id' => $professional->clinic_id,
            'end_time' => $endTime,
            'duration_minutes' => 30, // TODO: criar coluna na tabela specialty para duração padrão
        ]);

        $this->successMessage = 'Consulta agendada com sucesso!';

        $this->dispatch('appointmentCreated');

        $this->closeModal();
    }

    private function resetForm()
    {
        $this->specialty_id = null;
        $this->professional_id = null;
        $this->start_time = null;
        $this->professionals = [];
    }

    public function render()
    {
        return view('livewire.appointment-form');
    }
}