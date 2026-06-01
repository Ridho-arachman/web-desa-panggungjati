<?php

namespace App\Filament\Resources\News\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\DateTimePicker;
use Filament\Schemas\Components\Section;
use Illuminate\Support\Str;

class NewsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Konten')
                    ->schema([
                        TextInput::make('title')
                            ->label('Judul')
                            ->required()
                            ->live(debounce: 300)
                            ->afterStateUpdated(fn($set, $state) => $set('slug', Str::slug($state))),

                        TextInput::make('slug')
                            ->label('Slug')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->readonly(),

                        RichEditor::make('content')
                            ->label('Isi Berita')
                            ->required()
                            ->columnSpanFull(),

                        // Gambar utama (bisa tetap di tabel news)
                        FileUpload::make('image')
                            ->label('Gambar Utama')
                            ->image()
                            ->directory('berita')
                            ->columnSpanFull()
                            ->maxSize(2048)
                            ->disk('public'),

                        // Banyak gambar (maksimal 5)
                        FileUpload::make('images')
                            ->label('Galeri (maks. 5 gambar)')
                            ->image()
                            ->directory('berita/galeri')
                            ->multiple()
                            ->maxFiles(5)
                            ->reorderable()
                            ->columnSpanFull()
                            ->maxSize(2048)
                            ->disk('public'),
                    ])
                    ->columns(2),
                Section::make('Status')
                    ->schema([
                        Select::make('status')
                            ->label('Status')
                            ->options([
                                'draft' => 'Draft',
                                'published' => 'Publish',
                            ])
                            ->required()
                            ->default('draft')
                            ->live(),

                        DateTimePicker::make('published_at')
                            ->label('Tanggal Publish')
                            ->visible(fn($get) => $get('status') === 'published')
                            ->default(now())
                            ->time(true),
                    ])
                    ->columns(2),
            ]);
    }
}
