<?php

namespace App\Filament\Resources\Clinics\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ClinicForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nome da clínica')
                    ->required(),
                TextInput::make('cnpj')
                    ->label('CNPJ')
                    ->required(),
                TextInput::make('address')
                    ->label('Endereço')
                    ->required(),
                TextInput::make('city')
                    ->label('Cidade')
                    ->required(),
                TextInput::make('zip_code')
                    ->label('CEP')
                    ->required(),
                TextInput::make('phone')
                    ->label('Telefone')
                    ->tel()
                    ->required(),
                TextInput::make('email')
                    ->label('Endereço de e-mail')
                    ->email()
                    ->required(),
                TextInput::make('number_of_available_offices')
                    ->label('Número de consultórios disponíveis')
                    ->required()
                    ->numeric(),
                TextInput::make('average_consultation_duration_minutes')
                    ->label('Duração média da consulta (minutos)')
                    ->required()
                    ->numeric(),
            ]);
    }
}
