<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mudabbir extends Model
{
    protected $table = 'mudabbirs';

    protected $fillable = [
        'kamar',
        'nama',
        'urutan',
        'aktif',
    ];

    protected $casts = [
        'aktif' => 'boolean',
    ];

    protected function scopeAktif($query)
    {
        return $query->where('aktif', true);
    }
}
