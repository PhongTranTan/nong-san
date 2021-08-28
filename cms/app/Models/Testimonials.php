<?php

namespace App\Models;

use App\Traits\MetadataTrait;
use App\Traits\SlugTranslationTrait;
use App\Traits\TranslatableExtendTrait;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Testimonials extends Model
{
    use Translatable, TranslatableExtendTrait, TransformableTrait, MetadataTrait, SlugTranslationTrait;

    protected $table = 'testimonials';
    protected $fillable = [
        'images',
        'position',
        'active'
    ];

    public $translatedAttributes = [
        'name',
        'description',
    ];

    public $translationForeignKey = 'testimonials_id';

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }
}
