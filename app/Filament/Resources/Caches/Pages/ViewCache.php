<?php

namespace App\Filament\Resources\Caches\Pages;

use App\Filament\Resources\Caches\CacheResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewCache extends ViewRecord
{
    protected static string $resource = CacheResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
