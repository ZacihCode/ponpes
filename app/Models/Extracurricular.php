<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Extracurricular extends Model
{
    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'icon',
        'short_description',
        'description',
        'is_active',
        'order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(ExtracurricularCategory::class, 'category_id');
    }

    public function galleries()
    {
        return $this->hasMany(ExtracurricularGallery::class, 'extracurricular_id');
    }
}
