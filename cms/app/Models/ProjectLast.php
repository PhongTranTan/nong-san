<?php

namespace App\Models;

use App\Traits\MetadataTrait;
use App\Traits\TranslatableExtendTrait;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use App\Traits\ModelTrait;


class ProjectLast extends Model implements Transformable
{
    use Translatable, TranslatableExtendTrait, TransformableTrait, MetadataTrait;
    use ModelTrait;

    protected $table = 'project_last_update';
    protected $fillable = [
        'date',
        'project_id'
    ];

    public $translatedAttributes = [
        'content',
    ];

    public $translationForeignKey = 'project_last_update_id';
}
