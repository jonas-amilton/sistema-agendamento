<?php

namespace App\Filament\Resources\Patients\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;

class PatientForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('clinic_id')
                    ->label('Clínica')
                    ->relationship('clinic', 'name')
                    ->required(),
                TextInput::make('first_name')
                    ->label('Nome')
                    ->required(),
                TextInput::make('last_name')
                    ->label('Sobrenome')
                    ->required(),
                DatePicker::make('date_of_birth')
                    ->label('Data de Nascimento')
                    ->required(),
                TextInput::make('cpf')
                    ->label('CPF')
                    ->required(),
                TextInput::make('phone')
                    ->label('Telefone')
                    ->tel()
                    ->required(),
                TextInput::make('email')
                    ->label('Endereço de Email')
                    ->email()
                    ->required(),
                TextInput::make('password')
                    ->label('Senha')
                    ->password()
                    ->required()
                    ->dehydrateStateUsing(fn($state) => Hash::make($state)),
                TextInput::make('address')
                    ->label('Endereço')
                    ->required(),
                TextInput::make('city')
                    ->label('Cidade')
                    ->required(),
                TextInput::make('profession')
                    ->label('Profissão')
                    ->required(),
                TextInput::make('insurance_card_number')
                    ->label('Número do Cartão de convênio'),
            ]);
    }
}
