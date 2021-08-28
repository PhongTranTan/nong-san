<?php

namespace App\Models;

use App\Traits\MetadataTrait;
use App\Traits\SlugTranslationTrait;
use App\Traits\TranslatableExtendTrait;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Menu extends Model implements Transformable
{
    use \Dimsav\Translatable\Translatable, TranslatableExtendTrait,  TransformableTrait, MetadataTrait, SlugTranslationTrait;

    protected $table = 'menu';

    protected $fillable = [
        'type',
    ];

    public $translatedAttributes = [
        'title',
        'slug',
    ];

    public $slug_from_source = 'title';

    public function menuItems()
    {
        return $this->belongsToMany(MenuItem::class, "menu_menu_item", "menu_id", "menu_item_id");
    }
}
