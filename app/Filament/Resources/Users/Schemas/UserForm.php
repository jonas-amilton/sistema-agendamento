<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nome completo')
                    ->required(),
                TextInput::make('email')
                    ->label('Endereço de e-mail')
                    ->email()
                    ->required(),
                DateTimePicker::make('email_verified_at')
                    ->label('E-mail verificado em'),
                TextInput::make('password')
                    ->label('Senha')
                    ->password()
                    ->required(),
            ]);
    }
}
