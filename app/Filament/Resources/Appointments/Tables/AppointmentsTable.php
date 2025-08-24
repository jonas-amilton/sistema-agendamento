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
                TextColumn::make('clinic.name')
                    ->label('Clínica')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('patient.first_name')
                    ->label('Paciente')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('professional.first_name')
                    ->label('Profissional')
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
                    ->badge()
                    ->color(fn($state): string => match ($state) {
                        'scheduled' => 'primary',
                        'completed' => 'success',
                        'cancelled' => 'danger',
                        'no_show' => 'warning',
                        default => 'secondary',
                    })
                    ->icon(fn($state): string => match ($state) {
                        'scheduled' => 'heroicon-o-calendar',
                        'completed' => 'heroicon-o-check',
                        'cancelled' => 'heroicon-o-x',
                        'no_show' => 'heroicon-o-user-x',
                        default => 'heroicon-o-question-mark-circle',
                    })
                    ->formatStateUsing(fn($state) => match ($state) {
                        'scheduled' => 'Agendado',
                        'completed' => 'Concluído',
                        'cancelled' => 'Cancelado',
                        'no_show' => 'Não compareceu',
                        default => $state,
                    })
                    ->sortable()
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
