<?php

namespace App\Filament\Resources\CitizenInputs\Pages;

use App\Filament\Resources\CitizenInputs\CitizenInputResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCitizenInput extends EditRecord
{
    protected static string $resource = CitizenInputResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
