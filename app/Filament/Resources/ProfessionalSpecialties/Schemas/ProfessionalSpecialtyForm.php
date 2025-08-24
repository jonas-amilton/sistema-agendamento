<?php

namespace App\Filament\Resources\ProfessionalSpecialties\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ProfessionalSpecialtyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('professional_id')
                    ->label('ID do Profissional')
                    ->required()
                    ->numeric(),
                TextInput::make('specialty_id')
                    ->label('ID da Especialidade')
                    ->required()
                    ->numeric(),
            ]);
    }
}
