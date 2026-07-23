<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    protected $table = 'prestasis';

    protected $fillable = [
        'judul',
        'deskripsi',
        'urutan',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected function scopeOrdered($query)
    {
        return $query->orderBy('urutan');
    }

    protected function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
