<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class System extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = "systems";

    protected $fillable = [
        "key",
        "content"
    ];

    protected static $system;

    public $system_key = [
        'email',
        'address',
        'phone',
        'facebook',
        'youtube',
        'linkedin',
        'whatsapp',
        'website_title',
        'website_description',
        'website_keywords',
        'logo',
        'description_footer',  
        'images',
        'images_footer',
        'contact_title',
        'contact_description',
        'ads'
    ];

    // public function setContentAttribute($value)
    // {
    //     $this->attributes['content'] =  !empty($value) ? is_array($value) ? json_encode($value) : $value : null;
    // }

    public function setContentAttribute($value)
    {
        if (is_array($value)) {
            $this->attributes['content'] = json_encode($value);
        } else {
            $this->attributes['content'] = $value;
        }
    }

    public function getContentAttribute($string)
    {
        $json = json_decode($string, true);
        return (json_last_error() === JSON_ERROR_NONE) ? $json : $string;
    }

    // public function getContentAttribute($value)
    // {
    //     return jsonContent($value);
    // }

    public static function content($key, $default = null)
    {
        $model = self::$system ?? self::$system = self::select('key', 'content')->pluck('content', 'key')->toArray();
        if(!empty($model[$key]) && is_array($model[$key])){
            $locale = \App::getLocale();
            return $model[$key][$locale] ?? $default;
        }
        return $model[$key] ?? $default;
    }
}
