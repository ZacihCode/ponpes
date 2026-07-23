<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SejarahImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'sejarah_id',
        'gambar',
        'urutan',
    ];

    // Relasi balik ke induknya (Sejarah Pesantren / Yayasan)
    public function sejarah()
    {
        return $this->belongsTo(Sejarah::class);
    }

    /**
     * Accessor: otomatis menghasilkan URL lengkap gambar
     * Dipanggil dengan $image->url
     */
    protected function url(): \Illuminate\Database\Eloquent\Casts\Attribute
    {
        return \Illuminate\Database\Eloquent\Casts\Attribute::make(
            get: fn () => asset('storage/' . $this->gambar),
        );
    }
}
