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
                    ->required()
                    ->numeric(),
                TextInput::make('patient_id')
                    ->required()
                    ->numeric(),
                TextInput::make('professional_id')
                    ->required()
                    ->numeric(),
                DateTimePicker::make('start_time')
                    ->required(),
                DateTimePicker::make('end_time')
                    ->required(),
                TextInput::make('status')
                    ->required(),
                TextInput::make('duration_minutes')
                    ->required()
                    ->numeric(),
                Textarea::make('notes')
                    ->columnSpanFull(),
            ]);
    }
}
