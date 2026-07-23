<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Berita extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'slug',
        'excerpt',
        'konten',
        'gambar',
        'tanggal_publish',
        'status',
    ];

    protected $casts = [
        'tanggal_publish' => 'date',
    ];

    // auto generate slug from judul
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->judul);
            }
        });

        static::updating(function ($model) {
            if ($model->isDirty('judul')) {
                $model->slug = Str::slug($model->judul);
            }
        });
    }

    // scope untuk berita yang sudah terbit
    public function scopeTerbit($query)
    {
        return $query->where('status', 'terbit');
    }

    // format tanggal untuk tampil di frontend
    public function getTanggalFormatAttribute(): string
    {
        return $this->tanggal_publish->translatedFormat('d F Y');
    }
}
