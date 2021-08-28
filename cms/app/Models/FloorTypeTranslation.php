<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FloorTypeTranslation extends Model
{
    protected $table = 'floor_type_translation';

    protected $fillable = [
        'name',
    ];

    public $timestamps = false;
}
