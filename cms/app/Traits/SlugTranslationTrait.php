<?php namespace App\Traits;

trait SlugTranslationTrait
{
    public function updateSlugTranslation()
    {
        $config = config('slug_translation');

        $locales_expect = !empty($this->locales_expect) ? $this->locales_expect : $config['locales_expect'];
        $default_locale = !empty($this->default_locale) ? $this->default_locale : $config['default_locale'];
        $slug_from_source = !empty($this->slug_from_source) ? $this->slug_from_source : $config['slug_from_source'];

        $translations = $this->translations;
        $default_slug = null;
        foreach ($translations as $translation) {
            if ($translation->locale === $default_locale) {
                $default_slug = str_slug($translation->{$slug_from_source});
                break;
            }
        }

        foreach ($translations as $translation) {
            if (!$translation->{$slug_from_source}) {
                $translation->slug = null;
            } else {
                if (in_array($translation->locale, $locales_expect)) {
                    $translation->slug = str_slug($translation->{$slug_from_source});
                } else {
                    $translation->slug = $default_slug;
                }
            }
            // check exists slug
            if (!empty($translation->slug)) {
                $old_slug = $translation->slug;

                $checkBuilder = (clone $translation)->where('id', '<>', $translation->id);

                $i = 0;
                while ((clone $checkBuilder)->where('slug', $translation->slug)->count() > 0) {
                    $translation->slug = $old_slug . '-' . ++$i;
                }
            }
            $translation->save();
        }
    }
}