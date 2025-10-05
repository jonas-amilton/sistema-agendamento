<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Professional;
use App\Models\Specialty;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProfessionalSpecialty>
 */
class ProfessionalSpecialtyFactory extends Factory
{
    protected $model = \App\Models\ProfessionalSpecialty::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'professional_id' => Professional::factory(),
            'specialty_id' => Specialty::factory(),
        ];
    }
}
