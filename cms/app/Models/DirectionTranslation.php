<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DirectionTranslation extends Model
{
    protected $table = 'direction_translation';

    protected $fillable = [
        'name',
    ];

    public $timestamps = false;
}