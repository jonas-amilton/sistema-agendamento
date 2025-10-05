<?php

namespace Database\Factories;
use App\Models\Patient;
use App\Models\Professional;
use App\Models\Clinic;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointment>
 */
class AppointmentFactory extends Factory
{
    protected $model = \App\Models\Appointment::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $start = Carbon::now()->addDays(rand(1, 30))->setHour(rand(9, 16))->setMinute(0);
        $duration = 30;

        return [
            'clinic_id' => Clinic::factory(),
            'patient_id' => Patient::factory(),
            'professional_id' => Professional::factory(),
            'start_time' => $start,
            'end_time' => $start->copy()->addMinutes($duration),
            'status' => 'scheduled',
            'duration_minutes' => $duration,
        ];
    }
}
