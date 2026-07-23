<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    protected $table = 'agendas';

    protected $fillable = [
        'judul',
        'isi',
        'tipe',
        'urutan',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    // label badge untuk tampilan di admin
    public function getTipeLabelAttribute(): string
    {
        return match($this->tipe) {
            'info'    => 'Info',
            'warning' => 'Peringatan',
            'success' => 'Sukses',
            default   => 'Info',
        };
    }

    // class badge Bootstrap untuk tampilan di admin
    public function getTipeBadgeClassAttribute(): string
    {
        return match($this->tipe) {
            'info'    => 'badge-info',
            'warning' => 'badge-warning',
            'success' => 'badge-success',
            default   => 'badge-info',
        };
    }

    protected function scopeOrdered($query)
    {
        return $query->orderBy('urutan');
    }

    protected function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
