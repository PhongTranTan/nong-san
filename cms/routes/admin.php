<?php
use Illuminate\Support\Facades\Route;

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect' ,'admin']
    ],
    function () {
        Route::group(["prefix" => "admin"], function () {

            Auth::routes();

            Route::group(['middleware' => ['auth', "permission:admin.index"]], function () {

                Route::get('/', 'DashboardController@index')->name("admin.dashboard.index")->middleware("permission:admin.index");

                // Menu
                resourceAdmin('menu', 'MenuController', 'menu');
                resourceAdmin('menu-item', 'MenuItemController', 'menu.item');
                Route::get('get-theme', 'MenuItemController@getTheme')->name('get.theme');
                Route::post('menu-item-sort', 'MenuItemController@sort')->name('admin.menu.item.sort');

                // Banner
                resourceAdmin('banner', 'BannerController', 'banner');

                // Logo Partner
                resourceAdmin('partner', 'LogoPartnerController', 'logopartner');

                // News
                resourceAdmin('news', 'NewsController', 'news');

                // News Category
                resourceAdmin('news-category', 'NewsCategoryController', 'news.category');

                // Project
                resourceAdmin('products-types', 'ProductTypeController', 'product.types');

                // Contact
                resourceAdmin('contact', 'ContactController', 'contact');

                // Page
                resourceAdmin('themes', 'ThemeController', 'theme');

                Route::get('pages/create/load-block', 'PageController@loadBlock')->name("admin.page.load.block")->middleware("permission:admin.page.create", 'permission:admin.page.edit');

                resourceAdmin('pages', 'PageController', 'page');

                resourceAdmin('users', 'UserController', 'user');

                resourceAdmin('roles', 'RoleController', 'role');

                resourceAdmin('system', 'SystemController', 'system', 'system', ['show', 'index', 'create', 'destroy']);
            });
        });
    });
