<?php

namespace App\Filament\Resources\LetterTypeResource\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class LetterTypeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Jenis Surat')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Surat')
                            ->required()
                            ->maxLength(255)
                            ->live(debounce: 300)
                            ->afterStateUpdated(fn(callable $set, $state) => $set('slug', Str::slug($state))),

                        TextInput::make('slug')
                            ->label('Slug')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255)
                            ->readonly(),

                        RichEditor::make('description')
                            ->label('Deskripsi')
                            ->maxLength(65535)
                            ->columnSpanFull(),

                        TextInput::make('gform_link')
                            ->label('Link Google Form')
                            ->url()
                            ->required()
                            ->maxLength(255),

                        Toggle::make('is_active')
                            ->label('Aktif')
                            ->default(true)
                            ->inline(false),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
