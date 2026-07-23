<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluasi extends Model
{
    protected $table = 'evaluasis';

    protected $fillable = [
        'tipe',
        'judul',
        'deskripsi',
        'urutan',
    ];
}
