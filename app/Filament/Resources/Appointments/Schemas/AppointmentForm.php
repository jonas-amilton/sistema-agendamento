<?php

namespace App\Filament\Resources\Appointments\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class AppointmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('clinic_id')
                    ->label('ID da Clínica')
                    ->required()
                    ->numeric(),
                TextInput::make('patient_id')
                    ->label('ID do Paciente')
                    ->required()
                    ->numeric(),
                TextInput::make('professional_id')
                    ->label('ID do Profissional')
                    ->required()
                    ->numeric(),
                DateTimePicker::make('start_time')
                    ->label('Data e Hora de Início')
                    ->required(),
                DateTimePicker::make('end_time')
                    ->label('Data e Hora de Término')
                    ->required(),
                TextInput::make('status')
                    ->label('Status')
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
