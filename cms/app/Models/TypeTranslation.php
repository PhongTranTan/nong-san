<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeTranslation extends Model
{
    protected $table = 'type_translation';

    protected $fillable = [
        'name',
    ];

    public $timestamps = false;
}
