<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class News extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'content',
        'image',
        'author_id',
        'status',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    protected static function booted()
    {
        static::deleting(function (News $news) {
            // Hapus gambar utama
            if ($news->image) {
                Storage::disk('public')->delete($news->image);
            }

            // Hapus semua gambar galeri
            foreach ($news->images as $image) {
                Storage::disk('public')->delete($image->path);
            }
        });
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function images(): HasMany
    {
        return $this->hasMany(NewsImage::class)->orderBy('order');
    }
}
