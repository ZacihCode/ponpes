<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalHarian extends Model
{
    protected $table = 'jadwal_harians';

    protected $fillable = [
        'jam_mulai',
        'jam_selesai',
        'kegiatan',
        'urutan',
    ];

    protected function scopeOrdered($query)
    {
        return $query->orderBy('urutan');
    }
}
