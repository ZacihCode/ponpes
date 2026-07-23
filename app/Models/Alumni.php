<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    protected $table = 'alumnis';

    protected $fillable = [
        'tipe',
        'nama',
        'tahun_lulus',
        'badge',
        'profesi_atau_kampus',
        'deskripsi',
        'hafalan_juz',
        'foto',
        'urutan',
        'is_active',
    ];

    protected $casts = [
        'is_active'   => 'boolean',
        'tahun_lulus' => 'integer',
        'hafalan_juz' => 'integer',
        'urutan'      => 'integer',
    ];

    // Scope tipe
    public function scopeSebaran($query)
    {
        return $query->where('tipe', 'sebaran');
    }

    public function scopeKiprah($query)
    {
        return $query->where('tipe', 'kiprah');
    }

    // Scope aktif + urut
    public function scopeAktif($query)
    {
        return $query->where('is_active', true)->orderBy('urutan');
    }

    // Helper URL foto
    public function getFotoUrlAttribute(): string
    {
        return $this->foto
            ? asset('storage/' . $this->foto)
            : asset('images/default-alumni.jpg');
    }
}
