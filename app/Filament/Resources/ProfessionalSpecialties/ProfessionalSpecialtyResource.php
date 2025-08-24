<?php

namespace App\Filament\Resources\ProfessionalSpecialties;

use App\Filament\Resources\ProfessionalSpecialties\Pages\CreateProfessionalSpecialty;
use App\Filament\Resources\ProfessionalSpecialties\Pages\EditProfessionalSpecialty;
use App\Filament\Resources\ProfessionalSpecialties\Pages\ListProfessionalSpecialties;
use App\Filament\Resources\ProfessionalSpecialties\Schemas\ProfessionalSpecialtyForm;
use App\Filament\Resources\ProfessionalSpecialties\Tables\ProfessionalSpecialtiesTable;
use App\Models\ProfessionalSpecialty;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ProfessionalSpecialtyResource extends Resource
{
    protected static ?string $model = ProfessionalSpecialty::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Especialidade do Profissional';

    protected static ?string $navigationLabel = 'Especialidades dos Profissionais';

    public static function getModelLabel(): string
    {
        return 'Especialidade do Profissional';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Especialidades dos Profissionais';
    }

    public static function form(Schema $schema): Schema
    {
        return ProfessionalSpecialtyForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProfessionalSpecialtiesTable::configure($table);
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
            'index' => ListProfessionalSpecialties::route('/'),
            'create' => CreateProfessionalSpecialty::route('/create'),
            'edit' => EditProfessionalSpecialty::route('/{record}/edit'),
        ];
    }
}
