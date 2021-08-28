<?php

namespace App\Models;

use App\Traits\MetadataTrait;
use App\Traits\SlugTranslationTrait;
use App\Traits\TranslatableExtendTrait;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;


class SiborRates extends Model
{
    protected $table = 'sibor_rates';
    protected $fillable = [
        'month_sibor',
        'percent_sibor',
        'date',
        'active',
        'type'
    ];

    public $timestamps = false;

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }
}
