<?php

namespace App\Filament\Resources\Settings\Pages;

use App\Filament\Resources\Settings\SettingResource;
use Filament\Resources\Pages\CreateRecord;

class CreateSetting extends CreateRecord
{
    protected static string $resource = SettingResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $type = $data['type'];

        $data['value'] = match ($type) {
            'html' => $data['value_html'],
            'raw' => $data['value_raw'],     // Langsung ambil dari textarea mentah
            default => $data['value_text'],
        };

        unset($data['type'], $data['value_text'], $data['value_html'], $data['value_raw']);
        return $data;
    }
}
