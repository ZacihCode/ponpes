<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kurikulum extends Model
{
    protected $table = 'kurikulums';

    protected $fillable = [
        'tipe',
        'judul',
        'poin_poin',
        'urutan',
    ];

    protected $casts = [
        'poin_poin' => 'array',
    ];
}
