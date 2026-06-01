<?php

namespace App\Filament\Resources\CitizenInputs\Pages;

use App\Filament\Resources\CitizenInputs\CitizenInputResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCitizenInputs extends ListRecords
{
    protected static string $resource = CitizenInputResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label('Tambah Masukan'),
        ];
    }
}
