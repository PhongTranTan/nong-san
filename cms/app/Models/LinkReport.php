<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LinkReport extends Model
{
    protected $table = 'link_report';

    protected $fillable = [
        'report_title',
        'url',
        'project_choose',
        'estimate_rental',
        'estimate_capital',
        'banner_images',
        'banner_title',
        'banner_description',
        'description'
    ];

    public $timestamps = false;
}
