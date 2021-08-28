<?php

namespace App\Models;

use App\Traits\MetadataTrait;
use App\Traits\TranslatableExtendTrait;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use App\Traits\ModelTrait;


class Type extends Model implements Transformable
{
    use Translatable, TranslatableExtendTrait, TransformableTrait, MetadataTrait;
    use ModelTrait;

    protected $table = 'type';
    protected $fillable = [
        'active',
    ];

    public $translatedAttributes = [
        'name'
    ];

    public $translationForeignKey = 'type_id';
    public $timestamps = false;

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }
}
