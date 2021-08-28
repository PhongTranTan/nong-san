<?php

namespace App\Models;

use App\Traits\MetadataTrait;
use App\Traits\TranslatableExtendTrait;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use App\Traits\ModelTrait;


class NewsCategory extends Model implements Transformable
{
    use \Dimsav\Translatable\Translatable, TranslatableExtendTrait, TransformableTrait, MetadataTrait;

    protected $table = "news_categories";
    
    protected $fillable = [
        'icon',
        'active',
    ];
    
    public $translatedAttributes = [
        'name',
        'locale',
    ];

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }
}
