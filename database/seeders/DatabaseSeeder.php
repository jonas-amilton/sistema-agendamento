<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'Admin',
            'email' => 'admin@exemplo.com',
            'password' => Hash::make('12345699'),
        ]);

        // Criar especialidades fixas
        $specialties = ['Cardiologia', 'Dermatologia', 'Ortopedia', 'Pediatria', 'Ginecologia'];
        foreach ($specialties as $name) {
            \App\Models\Specialty::factory()->create(['name' => $name]);
        }

        // Criar clínicas
        \App\Models\Clinic::factory(3)->create()->each(function ($clinic) {
            // Criar profissionais para cada clínica
            \App\Models\Professional::factory(5)->create(['clinic_id' => $clinic->id])->each(function ($professional) {
                // Associar especialidades aleatórias
                $specialtyIds = \App\Models\Specialty::inRandomOrder()->take(rand(1, 3))->pluck('id');
                $professional->specialties()->attach($specialtyIds);
            });

            // Criar pacientes para cada clínica
            \App\Models\Patient::factory(10)->create(['clinic_id' => $clinic->id]);
        });

        // Criar agendamentos aleatórios
        \App\Models\Appointment::factory(20)->create();
    }
}
