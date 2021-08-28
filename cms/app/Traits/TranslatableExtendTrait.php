<?php namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait TranslatableExtendTrait
{
    public function scopeRequiredTranslation(Builder $query, $key = null)
    {
        if (empty($key)) {
            $key = 'slug';
        }
        $locale = \App::getLocale();
        return $query->whereHas('translations', function (Builder $query) use ($key, $locale) {
            $query->whereNotNull($this->getTranslationsTable() . '.' . $key);
            if ($locale) {
                $query->where($this->getTranslationsTable() . '.' . $this->getLocaleKey(), $locale);
            }
        });
    }
}