<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use \Dimsav\Translatable\Translatable;

    protected $table = "city";

    protected $fillable = [
        "country_id",
        "position"
    ];

    public $translatedAttributes = [
        'name'
    ];

    public $timestamps = false;

    public function careers()
    {
        return $this->belongsToMany(Career::class, 'career_city', 'city_id', 'career_id');
    }

    public function branches()
    {
        return $this->hasMany(Branch::class,'city_id');
    }
}
