<?php

namespace App\Filament\Resources\Settings\Pages;

use App\Filament\Resources\Settings\SettingResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSetting extends EditRecord
{
    protected static string $resource = SettingResource::class;

    protected function fillForm(): void
    {
        parent::fillForm();

        $record = $this->record;

        // Deteksi tipe berdasarkan isi
        if (strip_tags($record->value) != $record->value) {
            // Jika mengandung tag HTML, cek apakah iframe?
            $this->data['type'] = str_contains($record->value, '<iframe') ? 'raw' : 'html';
        } else {
            $this->data['type'] = 'text';
        }

        $this->data['value_text'] = $this->data['type'] === 'text' ? $record->value : '';
        $this->data['value_html'] = $this->data['type'] === 'html' ? $record->value : '';
        $this->data['value_raw'] = $this->data['type'] === 'raw' ? $record->value : '';
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $type = $data['type'];

        $data['value'] = match ($type) {
            'html' => $data['value_html'],
            'raw' => $data['value_raw'],
            default => $data['value_text'],
        };

        unset($data['type'], $data['value_text'], $data['value_html'], $data['value_raw']);
        return $data;
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
