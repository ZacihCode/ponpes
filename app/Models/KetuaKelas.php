<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KetuaKelas extends Model
{
    protected $table = 'ketua_kelas';

    protected $fillable = [
        'nama_kelas',
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
