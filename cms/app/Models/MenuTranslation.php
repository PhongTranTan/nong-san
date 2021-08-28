<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuTranslation extends Model
{
    protected $table = 'menu_translation';

    protected $fillable = [
        'title',
        'slug',
    ];

    public $timestamps = false;
}
