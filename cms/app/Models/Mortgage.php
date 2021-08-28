<?php

namespace App\Models;

use App\Traits\MetadataTrait;
use App\Traits\SlugTranslationTrait;
use App\Traits\TranslatableExtendTrait;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use App\Traits\ModelTrait;


class Mortgage extends Model implements Transformable
{
    use Translatable, TranslatableExtendTrait, TransformableTrait, MetadataTrait, SlugTranslationTrait;
    use ModelTrait;

    protected $table = 'mortgage';
    protected $fillable = [
        'position',
        'active',
        'premium',
        'images'
    ];

    public $translatedAttributes = [
        'issurer',
        'benefits'
    ];

    public $translationForeignKey = 'mortgage_id';

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }
}
