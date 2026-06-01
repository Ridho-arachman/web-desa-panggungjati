<?php

namespace App\Filament\Widgets;

use App\Models\CitizenInput;
use App\Models\LetterType;
use App\Models\News;
use App\Models\OrganizationMember;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DashboardStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Jenis Surat Aktif', LetterType::where('is_active', true)->count())
                ->description('Layanan tersedia')
                ->descriptionIcon('heroicon-o-document-text')
                ->color('primary')
                ->extraAttributes(['class' => 'rounded-xl']),

            Stat::make('Berita Published', News::where('status', 'published')->count())
                ->description('Total berita')
                ->descriptionIcon('heroicon-o-newspaper')
                ->color('success')
                ->extraAttributes(['class' => 'rounded-xl']),

            Stat::make('Masukan Warga', CitizenInput::count())
                ->description('Aspirasi diterima')
                ->descriptionIcon('heroicon-o-chat-bubble-left-right')
                ->color('warning')
                ->extraAttributes(['class' => 'rounded-xl']),

            Stat::make('Pengurus', OrganizationMember::count())
                ->description('Struktur organisasi')
                ->descriptionIcon('heroicon-o-user-group')
                ->color('danger')
                ->extraAttributes(['class' => 'rounded-xl']),
        ];
    }
}
