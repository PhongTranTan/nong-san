<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class MortgageTranslation extends Model
{
    protected $table = 'mortgage_translation';

    protected $fillable = [
        'issurer',
        'benefits'
    ];

    public $timestamps = false;
}
