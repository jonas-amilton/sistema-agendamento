<?php

namespace App\Filament\Resources\Appointments\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class AppointmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('clinic_id')
                    ->label('Clínica')
                    ->relationship('clinic', 'name')
                    ->required(),
                Select::make('patient_id')
                    ->label('Paciente')
                    ->relationship('patient', 'first_name')
                    ->required(),
                Select::make('professional_id')
                    ->label('Profissional')
                    ->relationship('professional', 'first_name')
                    ->required(),
                DateTimePicker::make('start_time')
                    ->label('Data e Hora de Início')
                    ->required(),
                DateTimePicker::make('end_time')
                    ->label('Data e Hora de Término')
                    ->required(),
                Select::make('status')
                    ->label('Status')
                    ->options([
                        'scheduled' => 'Agendado',
                        'completed' => 'Concluído',
                        'cancelled' => 'Cancelado',
                        'no_show' => 'Não compareceu',
                    ])
                    ->required(),
                TextInput::make('duration_minutes')
                    ->label('Duração (minutos)')
                    ->required()
                    ->numeric(),
                Textarea::make('notes')
                    ->label('Notas')
                    ->columnSpanFull(),
            ]);
    }
}
