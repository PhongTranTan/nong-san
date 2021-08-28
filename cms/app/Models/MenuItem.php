<?php

namespace App\Models;

use App\Traits\MetadataTrait;
use App\Traits\SlugTranslationTrait;
use App\Traits\TranslatableExtendTrait;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class MenuItem extends Model implements Transformable
{
    use \Dimsav\Translatable\Translatable, TranslatableExtendTrait,  TransformableTrait, MetadataTrait, SlugTranslationTrait;

    protected $table = 'menu_item';

    protected $fillable = [
        'parent_id',
        'level',
        'type',
        'referencer_id',
        'position',
        'class',
        'target',
        'active',
        'layout_type'
    ];

    public $translatedAttributes = [
        'title',
        'slug',
        'image',
        'background_image',
        'url'
    ];

    public $slug_from_source = 'title';

    public function menus()
    {
        return $this->belongsToMany(Menu::class, "menu_menu_item", "menu_item_id", "menu_id");
    }

    public static function types($key = null)
    {
        $type = [
            'custom_link', // Default
            //'page' // Name table
        ];

        $arr = array();
        foreach($type as $value) {
            array_push($arr, [$value => strtolower($value)]);
        }

        $arr = array_collapse($arr);

        return $key ? $arr[$key] : $arr;
    }

    public static function target($key = null)
    {
        $type = [
            '_blank',
            '_self',
            '_parent',
            '_top'
        ];

        $arr = array();
        foreach($type as $value) {
            array_push($arr, [$value => strtolower($value)]);
        }
        $arr = array_collapse($arr);
        return $key ? $arr[$key] : $arr;
    }

    /* 
        $type_menu: header, footer, ...
    */
    public static function tree($parent_id = 0, $type_menu = 'header'){
        $result = self::select("*")
                ->whereHas('menus', function($query) use ($type_menu){
                    $query->where('menu.type', $type_menu);
                })
                ->where('parent_id', $parent_id)
                ->where('active', 1)
                ->orderBy('position', 'asc')
                ->withTranslation()
                ->get();

        foreach($result as $rs){
            $rs->trees = self::tree($rs->id, $type_menu);
        }

        return $result;
    }

    /* 
        All type menu
    */
    public static function treeCMS($parent_id = 0){
        $result = self::select("*")
                ->where('parent_id', $parent_id)
                ->get();

        foreach($result as $rs){
            $rs->trees = self::treeCMS($rs->id);
        }

        return $result;
    }

    // Show select option CMS
    public static function getSelectOption($list, $default = null, $root = 0, $plus = '»»') {
        $html = '';
        if($root === 0){
            $selected = $default === 0 ? 'selected' : '';
            $html = '<option value="0"'. $selected .'>Root</option>';
        }
        foreach ($list as $rs){
            $selected = $rs->id === $default ? 'selected' : '';
            $typeMenu = strtoupper(implode(', ', $rs->menus()->pluck('type')->toArray()));

            $html .= '<option '. $selected .' value='. $rs->id .'>'. $plus . $rs->title . ' (' . $typeMenu . ')' . '</option>';
            if($rs->trees && $rs->trees->count()){
                $html .= self::getSelectOption($rs->trees, $default, 1, $plus .'»»');
            }
        }

        return $html;
    }

    // Show menu item list in CMS
    public static function getMenuItemListCMS($tree = [])
    {
        $html = '';

        if(!$tree || !count($tree))
            $html .= '';
        else{
            $html .= '<ul class="list-unstyled sortable-menu-item">';
            foreach ($tree->sortBy('position') as $rs) {
                $linkEdit   = route("admin.menu.item.edit", $rs->id);
                $linkDelete = route("admin.menu.item.destroy", $rs->id);
                $class      = count($rs->trees) ? 'd-name' : '';
                $typeMenu  = strtoupper(implode(', ', $rs->menus()->pluck('type')->toArray()));
                $active = $rs->active == 1 ? 'Active' : 'In-Active';

                $html .= '<li class="list-group-item" data-id="'. $rs->id .'">';
                $html .= '<div class="c-name '. $class .'">';
                $html .= $rs->position. '. '. $rs->title .'<span> ('. $typeMenu .') </span>';
                $html .= '<span class="btn-edit-category" style="right: 108px;"> ('. $active .') </span>';
                $html .= '<a class="btn-edit-category btn btn-xs btn-info" type="button" href="'. $linkEdit .'">Edit</a>';
                $html .= ' <button class="btn-delete-record btn btn-xs btn-danger btn-delete" type="button" data-title="Do you want to remove <strong>'. $rs->title .'</strong>?" data-url="'. $linkDelete .'">Delete</button></div>';

                if($rs->trees || count($rs->trees)){
                    $html .= self::getMenuItemListCMS($rs->trees);
                }
                $html .= '</li>';
            }

            $html .= '</ul>';
        }

        return $html;
    }
}