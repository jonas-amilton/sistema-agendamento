<?php

namespace App\Filament\Resources\Sessions\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class SessionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('id')
                    ->label('ID'),
                TextEntry::make('user_id')
                    ->numeric(),
                TextEntry::make('ip_address'),
                TextEntry::make('last_activity')
                    ->numeric(),
            ]);
    }
}
