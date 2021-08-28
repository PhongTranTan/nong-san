<?php


namespace App\Traits;


use Illuminate\Database\Eloquent\Builder;

/**
 * @method static Builder activeAndSort(array $sorts = [['position' => 'asc']])
 * @method static Builder findBySlug(string $slug, $with = [])
 */
trait ModelTrait
{
    public function scopeActiveAndSort(Builder $query, $sorts = ['position' => 'asc'])
    {
        $q = $query->where('active',1);
        foreach ($sorts as $key=>$direction){
            $q = $q->orderBy($key, $direction);
        }
        return $q;
    }

    public function scopeFindBySlug(Builder $query, $slug, $with = [])
    {
        $model = $query->whereTranslation('slug', $slug);
        if (!empty($with)) {
            $model->with($with);
        }
        return $model->firstOrFail();
    }
}
