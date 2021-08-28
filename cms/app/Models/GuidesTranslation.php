<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuidesTranslation extends Model
{
    protected $table = 'guides_translation';

    protected $fillable = [
        'title',
        'slug',
        'description',
        'content'
    ];

    public $timestamps = false;
}
