<?php

namespace App\Filament\Resources\Professionals\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ProfessionalForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('clinic_id')
                    ->label('ID da clínica')
                    ->required()
                    ->numeric(),
                TextInput::make('first_name')
                    ->label('Nome')
                    ->required(),
                TextInput::make('last_name')
                    ->label('Sobrenome')
                    ->required(),
                DatePicker::make('date_of_birth')
                    ->label('Data de nascimento')
                    ->required(),
                TextInput::make('cpf')
                    ->label('CPF')
                    ->required(),
                TextInput::make('address')
                    ->label('Endereço')
                    ->required(),
                TextInput::make('city')
                    ->label('Cidade')
                    ->required(),
                TextInput::make('phone')
                    ->label('Telefone')
                    ->tel()
                    ->required(),
                TextInput::make('email')
                    ->label('Endereço de e-mail')
                    ->email()
                    ->required(),
                TextInput::make('professional_registration_number')
                    ->label('Número de registro profissional')
                    ->required(),
                TextInput::make('registration_entity')
                    ->label('Entidade de registro')
                    ->required(),
            ]);
    }
}
