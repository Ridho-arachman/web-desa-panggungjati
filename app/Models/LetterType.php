<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LetterType extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'gform_link',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
