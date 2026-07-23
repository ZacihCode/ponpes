<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExtracurricularGallery extends Model
{
    protected $fillable = [
        'extracurricular_id',
        'image',
        'order',
    ];

    public function extracurricular()
    {
        return $this->belongsTo(Extracurricular::class, 'extracurricular_id');
    }
}
