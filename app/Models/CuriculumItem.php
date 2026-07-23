<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CuriculumItem extends Model
{
    protected $fillable = [
        'icon',
        'title',
        'description',
        'order',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];
}
