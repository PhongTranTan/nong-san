<?php

namespace App\Providers;

use App\Http\ViewComposers\GlobalComposer;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\MenuItem;
use Illuminate\Support\Facades\DB;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            $locales = \LaravelLocalization::getSupportedLocales();
            $view->with('composer_locales', $locales);
            $view->with('composer_locale', \App::getLocale());
        });
        View::composer([
            'frontend.*',
            'themes.*'
        ], GlobalComposer::class);
        View::composer([
            'frontend.*',
            'themes.*'
        ], function ($view){
            $settings = DB::table('systems')->get();
            $arr_setting = [];
            if($settings != null){
                foreach($settings as $setting){
                    $arr_setting[$setting->key] = $setting->content;
                }
            }
            $view->with(
                [
                    'arr_setting' => $arr_setting
                ]
            );
        });
        View::composer([
            'admin.layouts.partials.menu',
            'admin.dashboard.index',
        ], function ($view) {
            $auth = Auth::user();
            $value = [];
            if($auth){
                $value =  $auth->getPermissions()->pluck('slug')->toArray();
            }
            $view->with('composer_auth_permissions', $value);
        });
        View::composer(
            [
                'frontend.layouts.partials.header'
            ], function ($view) {
            $menu = MenuItem::tree(0, 'header');
            $view->with('composer_menu', $menu);
        });
        View::composer(
            [
                'frontend.layouts.partials.footer', 'frontend.project.footer'
            ], function ($view) {
            $menu_footer = MenuItem::tree(0, 'footer');
            $view->with('composer_footer', $menu_footer);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
