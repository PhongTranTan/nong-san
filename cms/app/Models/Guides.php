<?php

namespace App\Models;

use App\Traits\MetadataTrait;
use App\Traits\SlugTranslationTrait;
use App\Traits\TranslatableExtendTrait;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Guides extends Model
{
    use \Dimsav\Translatable\Translatable, TranslatableExtendTrait, TransformableTrait, MetadataTrait, SlugTranslationTrait;

    protected $table = 'guides';
    protected $fillable = [
        'highlight',
        'active',
        'images',
        'publish_date',
        'guides_category_id',
    ];

    public $translatedAttributes = [
        'title',
        'slug',
        'description',
        'content'
    ];

    public $slug_from_source = 'title';

    public $translationForeignKey = 'guides_id';

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    public function scopeHighlight($query)
    {
        return $query->where('highlight', 1);
    }

    public function scopePublishdate($query)
    {
        $date = \Carbon\Carbon::now();
        return $query->where('publish_date','<', $date);
    }

    public function guidesCategory()
    {
        return $this->belongsTo(GuidesCategory::class, 'guides_category_id');
    }

    public function scopeSortDesc($query)
    {
        return $query->orderBy('publish_date','DESC');
    }
}
