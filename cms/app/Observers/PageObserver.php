<?php

namespace App\Observers;

use App\Models\Page;

class PageObserver
{
    /**
     * Listen to the User created event.
     *
     * @param  \App\User $user
     * @return void
     */
    public function created(Page $page)
    {
        $this->removeCache($page);
    }

    /**
     * Listen to the User deleting event.
     *
     * @param  \App\User $user
     * @return void
     */
    public function updated(Page $page)
    {
        $this->removeCache($page);
    }

    private function removeCache($page)
    {
        $locales = \LaravelLocalization::getSupportedLocales();

        // Remove cache page menu
        foreach ($locales as $key => $value) {
            if ($page->group_code === 'ABOUT-US') {
                \Cache::forget("{$key}_composer_about_us");
            }

            if ($page->group_code === 'GLOBAL') {
                \Cache::forget("{$key}_composer_global_pages");
            }
        }
    }
}