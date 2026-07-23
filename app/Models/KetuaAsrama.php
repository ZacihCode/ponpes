<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KetuaAsrama extends Model
{
    protected $table = 'ketua_asramas';

    protected $fillable = [
        'nama_asrama',
        'nama_ketua',
        'icon',
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
