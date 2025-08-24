<?php

namespace App\Filament\Resources\ProfessionalSpecialties\Pages;

use App\Filament\Resources\ProfessionalSpecialties\ProfessionalSpecialtyResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListProfessionalSpecialties extends ListRecords
{
    protected static string $resource = ProfessionalSpecialtyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
