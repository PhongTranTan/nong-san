<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectTranslation extends Model
{
    protected $table = 'project_translation';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'project_ticker_text',
        'tag',
        'project_text_grid',
        'project_price_title',
        'project_price_description',
        'project_price_name_detail',
        'project_address',
        'project_location',
        'project_price_subtitle',
        'location_title',
        'location_subtitle',
        'location_description',
        'gallery_title',
        'gallery_subtitle',
        'gallery_description',
        'floorplan_title',
        'floorplan_subtitle',
        'floorplan_description',
        'contact_title',
        'contact_subtitle',
        'contact_description',
    ];

    public $timestamps = false;
}
