<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectFloorTranslation extends Model
{
    protected $table = 'project_floor_translation';

    protected $fillable = [
        'content',
        'unit'
    ];

    public $timestamps = false;
}
