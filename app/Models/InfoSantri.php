<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InfoSantri extends Model
{
    protected $fillable = [
        'foto',
        'kategori',
        'judul',
        'deskripsi',
        'nama',
        'kelas',
        'tahun',
        'urutan',
    ];
}
