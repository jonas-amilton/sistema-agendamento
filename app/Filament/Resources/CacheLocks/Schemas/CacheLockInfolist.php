<?php

namespace App\Filament\Resources\CacheLocks\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class CacheLockInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('key'),
                TextEntry::make('owner'),
                TextEntry::make('expiration')
                    ->numeric(),
            ]);
    }
}
