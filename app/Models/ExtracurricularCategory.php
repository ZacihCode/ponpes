<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExtracurricularCategory extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'order',
    ];

    public function extracurriculars()
    {
        return $this->hasMany(Extracurricular::class, 'category_id');
    }
}
