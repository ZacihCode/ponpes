<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OstdaquPosition extends Model
{
    protected $table = 'ostdaqu_positions';

    protected $fillable = [
        'jabatan',
        'nama',
        'icon',
        'tipe',
        'urutan',
        'aktif',
    ];

    protected $casts = [
        'aktif' => 'boolean',
    ];

    public function scopeAktif($query)
    {
        return $query->where('aktif', true);
    }

    public function scopeKetua($query)
    {
        return $query->where('tipe', 'ketua');
    }

    public function scopeAnggota($query)
    {
        return $query->where('tipe', 'anggota');
    }
}
