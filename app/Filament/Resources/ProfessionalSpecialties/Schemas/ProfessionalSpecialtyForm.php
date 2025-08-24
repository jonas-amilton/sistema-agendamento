<?php

namespace App\Filament\Resources\ProfessionalSpecialties\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ProfessionalSpecialtyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('professional_id')
                    ->label('Profissional')
                    ->relationship('professional', 'first_name')
                    ->required(),
                Select::make('specialty_id')
                    ->label('Especialidade')
                    ->relationship('specialty', 'name')
                    ->required()
            ]);
    }
}
