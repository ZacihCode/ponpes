<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CharacterSection extends Model
{
    protected $fillable = [
        'section_title',
        'title',
        'description',
    ];
}
