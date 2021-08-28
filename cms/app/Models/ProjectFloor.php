<?php

namespace App\Models;

use App\Traits\MetadataTrait;
use App\Traits\TranslatableExtendTrait;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use App\Traits\ModelTrait;


class ProjectFloor extends Model implements Transformable
{
    use Translatable, TranslatableExtendTrait, TransformableTrait, MetadataTrait;
    use ModelTrait;

    protected $table = 'project_floor';
    protected $fillable = [
        'floor_category_id',
        'floor_type_id',
        'project_id',
        'image',
        'pdf'
    ];

    public $translatedAttributes = [
        'content',
        'unit'
    ];

    public $translationForeignKey = 'project_floor_id';
}
