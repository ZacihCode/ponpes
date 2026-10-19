<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sejarah extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipe',
        'judul',
        'konten',
    ];

    // konstanta biar ga ada "magic string" tersebar di controller
    const TIPE_PESANTREN = 'pesantren';
    const TIPE_YAYASAN = 'yayasan';

    const TIPE_LABELS = [
        self::TIPE_PESANTREN => 'Sejarah Pesantren',
        self::TIPE_YAYASAN => 'Sejarah Yayasan Assanadiyah',
    ];

    /**
     * Relasi ke gambar-gambar carousel, diurutkan sesuai kolom 'urutan'
     */
    public function images()
    {
        return $this->hasMany(SejarahImage::class)->orderBy('urutan');
    }
}
