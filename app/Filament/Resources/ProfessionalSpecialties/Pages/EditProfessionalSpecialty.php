<?php

namespace App\Filament\Resources\ProfessionalSpecialties\Pages;

use App\Filament\Resources\ProfessionalSpecialties\ProfessionalSpecialtyResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditProfessionalSpecialty extends EditRecord
{
    protected static string $resource = ProfessionalSpecialtyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
