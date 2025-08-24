<?php

namespace App\Filament\Resources\Appointments\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AppointmentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('clinic_id')
                    ->label('ID da Clínica')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('patient_id')
                    ->label('ID do Paciente')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('professional_id')
                    ->label('ID do Profissional')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('start_time')
                    ->label('Início')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('end_time')
                    ->label('Fim')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('status')
                    ->label('Status')
                    ->searchable(),
                TextColumn::make('duration_minutes')
                    ->label('Duração (minutos)')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Atualizado em')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
