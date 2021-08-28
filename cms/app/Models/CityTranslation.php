<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CityTranslation extends Model
{
    protected $table = "city_translation";

    protected $fillable = [
        'name'
    ];

    public $timestamps = false;
}
