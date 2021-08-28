<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectLastTranslation extends Model
{
    protected $table = 'project_last_update_translation';

    protected $fillable = [
        'content',
    ];

    public $timestamps = false;
}
