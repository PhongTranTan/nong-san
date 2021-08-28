<?php

namespace App\Models;

use App\Traits\MetadataTrait;
use App\Traits\SlugTranslationTrait;
use App\Traits\TranslatableExtendTrait;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class District extends Model implements Transformable
{
    use \Dimsav\Translatable\Translatable, TranslatableExtendTrait,  TransformableTrait, MetadataTrait, SlugTranslationTrait;

    protected $table = 'district';

    protected $fillable = [
        'active',
    ];

    public $translationForeignKey = 'district_id';

    public $translatedAttributes = [
        'name',
    ];

    public $timestamps = false;

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }
}
