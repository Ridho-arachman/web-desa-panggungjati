<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class NewsImage extends Model
{
    protected $fillable = ['news_id', 'path', 'order'];

    protected static function booted()
    {
        static::deleting(function (NewsImage $image) {
            if ($image->path) {
                Storage::disk('public')->delete($image->path);
            }
        });
    }

    public function news(): BelongsTo
    {
        return $this->belongsTo(News::class);
    }
}
