<?php

namespace App\Models;

use App\Traits\MetadataTrait;
use App\Traits\SlugTranslationTrait;
use App\Traits\TranslatableExtendTrait;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Project extends Model 
{
    use \Dimsav\Translatable\Translatable, TranslatableExtendTrait, TransformableTrait, MetadataTrait, SlugTranslationTrait;

    protected $table = 'project';
    protected $fillable = [
        'district_id',
        'tenure_id',
        'type_id',
        'direction_id',
        'purpose_id',
        'project_grid',
        'project_logo',
        'project_more_url',
        'project_gallery',
        'project_background_section',
        'project_watermark',
        'project_watermark_position',
        'project_lastest_launches',
        'project_heavily_discount',
        'project_investor',
        'project_mear_mrt',
        'project_price',
        'project_price_table',
        'project_price_images',
        'project_slides',
        'active',
        'star_buy',
        'develop',
        'phone',
        'freehold',
        'location',
        'lat',
        'lng',
        'estimated_rental_yield',
        'estimated_capital_appreciation',
        'custom_report',
        'map_shape',
        'whatsapp',
        'email',
        'option',
        'link_backup',
        'near_place',
        'position',
        // 'facebook',
        // 'twitter',
        // 'linkedin'
        'pdf_all',
        'show_pdf',
        'image_pdf_all',
    ];

    public $translatedAttributes = [
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

    public $slug_from_source = 'name';

    public $translationForeignKey = 'project_id';

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    public function scopePosition($query)
    {
        return $query->orderBy('position');
    }

    public function floors()
    {
        return $this->hasMany(ProjectFloor::class, 'project_id');
    }
}
