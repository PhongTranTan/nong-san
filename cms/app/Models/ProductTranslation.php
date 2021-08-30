<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductTranslation extends Model
{
    protected $fillable = [
        'product_id',
        'locale',
        'name',
        'slug',
        'description',
        'content'
    ];

    public $timestamps = false;
}
