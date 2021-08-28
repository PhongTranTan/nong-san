<?php

namespace App\Models;

use App\Traits\MetadataTrait;
use App\Traits\SlugTranslationTrait;
use App\Traits\TranslatableExtendTrait;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Carbon\Carbon;

class News  extends Model
{
    use \Dimsav\Translatable\Translatable, TranslatableExtendTrait, TransformableTrait, MetadataTrait, SlugTranslationTrait;

    protected $table = 'news';

    protected $fillable = [
        'highlight',
        'active',
        'images',
        'publish_date',
        'news_category_id',
    ];

    public $translatedAttributes = [
        'name',
        'slug',
        'description',
        'content'
    ];

    public $slug_from_source = 'name';

    public $translationForeignKey = 'news_id';

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
        $date = Carbon::now();
        return $query->where('publish_date','<', $date);
    }

    public function newsCategory()
    {
        return $this->belongsTo(NewsCategory::class, 'news_category_id');
    }

    public function scopeSortDesc($query)
    {
        return $query->orderBy('publish_date','DESC');
    }
}
