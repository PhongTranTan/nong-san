<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItemTranslation extends Model
{
    protected $table = 'menu_item_translation';

    protected $fillable = [
        'title',
        'slug',
        'image',
        'background_image',
        'url'
    ];

    public $timestamps = false;
}
