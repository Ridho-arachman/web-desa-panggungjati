<?php

namespace App\Filament\Resources\Settings\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;

class SettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Pengaturan')
                    ->schema([
                        TextInput::make('key')
                            ->label('Kunci')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Select::make('type')
                            ->label('Tipe Nilai')
                            ->options([
                                'text' => 'Teks Biasa',
                                'html' => 'HTML / Rich Text',
                                'raw' => 'HTML Mentah (iframe, script)',   // Opsi baru
                            ])
                            ->default('text')
                            ->live()
                            ->columnSpanFull(),

                        // Teks biasa tanpa format
                        Textarea::make('value_text')
                            ->label('Nilai')
                            ->visible(fn(Get $get): bool => $get('type') === 'text')
                            ->rows(4)
                            ->columnSpanFull(),

                        // RichEditor untuk konten format
                        RichEditor::make('value_html')
                            ->label('Nilai')
                            ->visible(fn(Get $get): bool => $get('type') === 'html')
                            ->columnSpanFull(),

                        // Textarea besar untuk HTML mentah (iframe, dll.)
                        Textarea::make('value_raw')
                            ->label('Nilai')
                            ->visible(fn(Get $get): bool => $get('type') === 'raw')
                            ->rows(8)
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
