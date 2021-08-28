<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsCategoryTranslation extends Model
{
    protected $fillable = [
        'name',
        'news_category_id',
        'locale',
    ];
    public $timestamps = false;
}
