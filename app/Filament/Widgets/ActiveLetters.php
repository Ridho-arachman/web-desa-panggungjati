<?php

namespace App\Filament\Widgets;

use App\Models\LetterType;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class ActiveLetters extends BaseWidget
{
    protected static ?int $sort = 3;

    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(LetterType::where('is_active', true))
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Surat'),
                Tables\Columns\TextColumn::make('description')
                    ->label('Deskripsi')
                    ->limit(50)
                    ->formatStateUsing(function (string $state): string {
                        // Bersihkan tag kosong lalu potong setelah 100 karakter (atau 200 karakter)
                        $clean = trim(strip_tags($state, '<b><i><u><ul><ol><li><br>')); // izinkan tag tertentu
                        return \Illuminate\Support\Str::limit($clean, 100, '...');
                    })
                    ->html(),
                Tables\Columns\TextColumn::make('gform_link')
                    ->label('Link GForm')
                    ->url(fn($record) => $record->gform_link, true)
                    ->limit(30),
            ])
            ->paginated(false)
            ->heading('Layanan Surat Aktif');
    }
}
