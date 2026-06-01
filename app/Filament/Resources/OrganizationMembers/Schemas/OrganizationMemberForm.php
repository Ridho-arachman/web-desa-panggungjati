<?php

namespace App\Filament\Resources\OrganizationMemberResource\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use App\Models\OrganizationMember;
use Filament\Schemas\Components\Section;

class OrganizationMemberForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Data Anggota')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('position')
                            ->label('Jabatan')
                            ->required()
                            ->maxLength(255),

                        FileUpload::make('photo')
                            ->label('Foto')
                            ->image()
                            ->directory('organisasi'),

                        Select::make('parent_id')
                            ->label('Atasan Langsung')
                            ->options(OrganizationMember::pluck('position', 'id'))
                            ->searchable()
                            ->nullable(),

                        TextInput::make('order')
                            ->label('Urutan')
                            ->numeric()
                            ->default(0),
                    ])
                    ->columns(2),
            ]);
    }
}
