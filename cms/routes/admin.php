<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect' ,'admin']
    ],
    function () {
        Route::group(["prefix" => "admin"], function () {
            Auth::routes();
            Route::group(['middleware' => ['auth', "permission:admin.index"]], function () {
                Route::get('/', 'DashboardController@index')
                    ->name("admin.dashboard.index")
                    ->middleware("permission:admin.index");
                resourceAdmin('menu', 'MenuController', 'menu');
                resourceAdmin('menu-item', 'MenuItemController', 'menu.item');
                Route::get('get-theme', 'MenuItemController@getTheme')->name('get.theme');
                Route::post('menu-item-sort', 'MenuItemController@sort')->name('admin.menu.item.sort');
                resourceAdmin('banner', 'BannerController', 'banner');
                resourceAdmin('partner', 'LogoPartnerController', 'logopartner');
                resourceAdmin('news', 'NewsController', 'news');
                resourceAdmin('news-category', 'NewsCategoryController', 'news.category');
                resourceAdmin('products-types', 'ProductTypeController', 'product.types');
                resourceAdmin('products', 'ProductController', 'product');
                resourceAdmin('contact', 'ContactController', 'contact');
                resourceAdmin('themes', 'ThemeController', 'theme');
                Route::get('pages/create/load-block', 'PageController@loadBlock')
                    ->name("admin.page.load.block")
                    ->middleware("permission:admin.page.create", 'permission:admin.page.edit');
                resourceAdmin('pages', 'PageController', 'page');
                resourceAdmin('users', 'UserController', 'user');
                resourceAdmin('roles', 'RoleController', 'role');
                resourceAdmin('system', 'SystemController', 'system', 'system', [
                    'show', 
                    'index', 
                    'create', 
                    'destroy'
                ]);
            });
        });
    });
