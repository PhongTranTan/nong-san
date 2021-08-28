<?php

namespace App\Models;

use App\Traits\MetadataTrait;
use App\Traits\TranslatableExtendTrait;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use App\Traits\ModelTrait;


class FloorCategory extends Model implements Transformable
{
    use Translatable, TranslatableExtendTrait, TransformableTrait, MetadataTrait;
    use ModelTrait;

    protected $table = 'floor_category';
    protected $fillable = [
        'active',
    ];

    public $translatedAttributes = [
        'name'
    ];

    public $translationForeignKey = 'floor_category_id';
}
