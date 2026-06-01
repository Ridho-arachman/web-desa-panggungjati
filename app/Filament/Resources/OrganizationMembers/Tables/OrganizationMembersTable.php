<?php

namespace App\Filament\Resources\OrganizationMemberResource\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;

class OrganizationMembersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('photo')
                    ->circular()
                    ->size(40)
                    ->label('Foto')
                    ->disk('public')
                    ->defaultImageUrl('/images/default-avatar.png'),

                TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('position')
                    ->label('Jabatan')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('parent.position')
                    ->label('Atasan')
                    ->sortable(),

                TextColumn::make('order')
                    ->label('Urutan')
                    ->sortable(),
            ])
            ->filters([])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
