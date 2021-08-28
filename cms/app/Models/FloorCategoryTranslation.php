<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FloorCategoryTranslation extends Model
{
    protected $table = 'floor_category_translation';

    protected $fillable = [
        'name',
    ];

    public $timestamps = false;
}
