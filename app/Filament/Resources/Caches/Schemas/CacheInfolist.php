<?php

namespace App\Filament\Resources\Caches\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class CacheInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('key'),
                TextEntry::make('expiration')
                    ->numeric(),
            ]);
    }
}
