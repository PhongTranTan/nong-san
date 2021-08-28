<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Country extends Model implements Transformable
{
    use \Dimsav\Translatable\Translatable, TransformableTrait;

    protected $table = 'country';

    protected $fillable = [
        'code',
        'position'
    ];

    public $translatedAttributes = [
        'name'
    ];

    public $timestamps = false;
}
