<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectGallery extends Model
{
    protected $table = 'project_gallery';

    public $timestamps = false;

    protected $fillable = [
        'project_id',
        'images',
        'position',
        'status',
    ];
}
