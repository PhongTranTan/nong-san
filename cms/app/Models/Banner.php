<?php

namespace App\Models;

use App\Traits\MetadataTrait;
use App\Traits\SlugTranslationTrait;
use App\Traits\TranslatableExtendTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use App\Traits\ModelTrait;


class Banner extends Model implements Transformable
{
    use \Dimsav\Translatable\Translatable, TranslatableExtendTrait, TransformableTrait, MetadataTrait, SlugTranslationTrait;
    use ModelTrait;

    protected $table = 'banner';
    protected $fillable = [
        'page_id',
        'position',
        'active',
        'image',
    ];

    public $translatedAttributes = [
        'title',
        'description',
        'button_name'
    ];

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    public function page()
    {
        return $this->belongsTo(Page::class, 'page_id');
    }
}
