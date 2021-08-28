<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class BannerTranslation extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'banner_translation';

    protected $fillable = [
        'title',
        'description',
        'button_name'
    ];

    public $timestamps = false;
}
