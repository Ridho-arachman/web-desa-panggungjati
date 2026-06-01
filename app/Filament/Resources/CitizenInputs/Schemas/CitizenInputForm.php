<?php

namespace App\Filament\Resources\CitizenInputs\Schemas;

use Filament\Schemas\Schema;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;

class CitizenInputForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Data Pemohon')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->maxLength(255),

                        TextInput::make('phone')
                            ->label('Telepon')
                            ->tel()
                            ->maxLength(20),
                    ])
                    ->columns(2),

                Section::make('Pesan')
                    ->schema([
                        Textarea::make('message')
                            ->label('Masukan / Aspirasi')
                            ->required()
                            ->columnSpanFull(),
                    ]),

                Section::make('Status & Tanggapan')
                    ->schema([
                        Select::make('status')
                            ->label('Status')
                            ->options([
                                'baru' => 'Baru',
                                'dibaca' => 'Dibaca',
                                'ditanggapi' => 'Ditanggapi',
                            ])
                            ->required()
                            ->default('baru'),

                        Textarea::make('admin_response')
                            ->label('Tanggapan Admin')
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
