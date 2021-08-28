<?php

namespace App\Models;

use App\Traits\MetadataTrait;
use App\Traits\SlugTranslationTrait;
use App\Traits\TranslatableExtendTrait;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Traits\TransformableTrait;

class ProductType extends Model 
{
    use \Dimsav\Translatable\Translatable, 
        TranslatableExtendTrait, 
        TransformableTrait, 
        MetadataTrait, 
        SlugTranslationTrait;

    protected $table = 'product_types';

    protected $fillable = [
        'display_order',
        'active',
        'images'
    ];

    public $translatedAttributes = [
        'locale',
        'name',
        'slug',
        'description'
    ];

    public $slug_from_source = 'name';

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    public function scopePosition($query)
    {
        return $query->orderBy('display_order');
    }
}
