<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CharacterCarousel extends Model
{
    protected $fillable = [
        'image',
        'title',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
