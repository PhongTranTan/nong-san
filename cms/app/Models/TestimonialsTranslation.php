<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestimonialsTranslation extends Model
{
    protected $table = 'testimonials_translation';

    protected $fillable = [
        'name',
        'description'
    ];

    public $timestamps = false;
}
