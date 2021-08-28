<?php

namespace App\Providers;

use App\Models\Page;
use App\Observers\PageObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Log by user
        $user = exec('whoami');
        $user = str_slug($user);
        // \Log::getMonolog()->popHandler();
        // \Log::useDailyFiles(storage_path('/logs/laravel-') . $user . '.log');

        // Remove cache after delete or update
        Page::observe(PageObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
