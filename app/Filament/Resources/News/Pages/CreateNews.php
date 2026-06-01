<?php

namespace App\Filament\Resources\News\Pages;

use App\Filament\Resources\News\NewsResource;
use App\Models\NewsImage;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateNews extends CreateRecord
{
    protected static string $resource = NewsResource::class;
    public array $uploadedImages = [];

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['author_id'] = Auth::id();
        $this->uploadedImages = $data['images'] ?? [];
        unset($data['images']);
        return $data;
    }

    protected function afterCreate(): void
    {
        $images = $this->uploadedImages ?? [];
        $paths = array_values($images);

        foreach ($paths as $order => $path) {
            if (is_string($path)) {
                NewsImage::create([
                    'news_id' => $this->record->id,
                    'path' => $path,
                    'order' => $order,
                ]);
            }
        }
    }
}
