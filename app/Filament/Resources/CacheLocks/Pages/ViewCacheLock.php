<?php

namespace App\Filament\Resources\CacheLocks\Pages;

use App\Filament\Resources\CacheLocks\CacheLockResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewCacheLock extends ViewRecord
{
    protected static string $resource = CacheLockResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
