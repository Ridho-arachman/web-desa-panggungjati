<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class OrganizationMember extends Model
{
    protected $fillable = [
        'name',
        'position',
        'photo',
        'parent_id',
        'order',
    ];

    protected static function booted()
    {
        static::deleting(function (OrganizationMember $member) {
            if ($member->photo) {
                Storage::disk('public')->delete($member->photo);
            }
        });
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id')->orderBy('order');
    }
}
