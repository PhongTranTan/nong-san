<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuidesCategoryTranslation extends Model
{
    protected $fillable = [
        'name',
        'guides_category_id',
        'locale',
    ];
    public $timestamps = false;
}
