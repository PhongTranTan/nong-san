<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductTypeTranslation extends Model
{
    protected $fillable = [
        'product_type_id',
        'locale',
        'name',
        'slug',
        'description'
    ];

    public $timestamps = false;
}
