<?php

namespace App\Filament\Resources\News\Pages;

use App\Filament\Resources\News\NewsResource;
use App\Models\NewsImage;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditNews extends EditRecord
{
    protected static string $resource = NewsResource::class;

    public array $uploadedImages = [];

    // 🔥 Tambahkan ini: isi data gambar saat form pertama kali dimuat
    protected function fillForm(): void
    {
        parent::fillForm();

        // Ambil path gambar yang sudah ada dari tabel news_images
        $this->data['images'] = $this->record->images->pluck('path')->toArray();
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $this->uploadedImages = $data['images'] ?? [];
        unset($data['images']);
        return $data;
    }

    protected function afterSave(): void
    {
        $images = $this->uploadedImages;
        $record = $this->record;

        $record->images()->delete();

        $paths = array_values($images);

        foreach ($paths as $order => $path) {
            if (is_string($path)) {
                NewsImage::create([
                    'news_id' => $record->id,
                    'path' => $path,
                    'order' => $order,
                ]);
            }
        }
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
