<?php

namespace App\Filament\Resources\CacheLocks;

use App\Filament\Resources\CacheLocks\Pages\CreateCacheLock;
use App\Filament\Resources\CacheLocks\Pages\EditCacheLock;
use App\Filament\Resources\CacheLocks\Pages\ListCacheLocks;
use App\Filament\Resources\CacheLocks\Pages\ViewCacheLock;
use App\Filament\Resources\CacheLocks\Schemas\CacheLockForm;
use App\Filament\Resources\CacheLocks\Schemas\CacheLockInfolist;
use App\Filament\Resources\CacheLocks\Tables\CacheLocksTable;
use App\Models\CacheLock;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CacheLockResource extends Resource
{
    protected static ?string $model = CacheLock::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'CacheLock';

    public static function form(Schema $schema): Schema
    {
        return CacheLockForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return CacheLockInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CacheLocksTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCacheLocks::route('/'),
            'create' => CreateCacheLock::route('/create'),
            'view' => ViewCacheLock::route('/{record}'),
            'edit' => EditCacheLock::route('/{record}/edit'),
        ];
    }
}
