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

                // Customer
                resourceAdmin('customer', 'CustomerController', 'customer');

                // Banner
                resourceAdmin('banner', 'BannerController', 'banner');

                // Sibor Rates
                resourceAdmin('sibor-rates', 'SiborRatesController', 'siborrates');

                // Logo Partner
                resourceAdmin('partner', 'LogoPartnerController', 'logopartner');

                // Guides
                resourceAdmin('guides', 'GuidesController', 'guides');

                // Guides Category
                resourceAdmin('guides-category', 'GuidesCategoryController', 'guides.category');

                // News
                resourceAdmin('news', 'NewsController', 'news');

                // News Category
                resourceAdmin('news-category', 'NewsCategoryController', 'news.category');

                // Mortgage Rates
                resourceAdmin('mortgage-rates', 'MortgageController', 'mortgage');

                // Review
                resourceAdmin('review', 'ReviewController', 'review');

                // District
                resourceAdmin('district', 'DistrictController', 'district');

                // Testimonials
                resourceAdmin('testimonials', 'TestimonialsController', 'testimonials');

                // Tenure
                resourceAdmin('tenure', 'TenureController', 'tenure');

                // Purpose
                resourceAdmin('purpose', 'PurposeController', 'purpose');

                // Direction
                resourceAdmin('direction', 'DirectionController', 'direction');

                // Budgets
                resourceAdmin('budgets', 'BudgetsController', 'budgets');

                // Project Type
                resourceAdmin('type', 'TypeController', 'type');

                Route::get('project/sort', 'ProjectController@sort')
                    ->name('project.sort');
                Route::put('project/update-sort', 'ProjectController@sortUpdate')
                    ->name('project.sort.update');
                Route::get('news/create-data-test', 'NewsController@storeDataTest')
                    ->name('news.data.test');
                Route::get('guides/create-data-test', 'GuidesController@storeDataTest')
                    ->name('guides.data.test');
                // Project
                resourceAdmin('project', 'ProjectController', 'project');

                // Link Report
                resourceAdmin('linkreport', 'LinkReportController', 'linkreport');

                // Project Floor Category
                resourceAdmin('floor-category', 'FloorCategoryController', 'floorcategory');

                // Project Floor Type
                resourceAdmin('floor-type', 'FloorTypeController', 'floortype');

                // Contact
                resourceAdmin('schedule', 'ScheduleController', 'schedule');

                // Contact
                resourceAdmin('contact', 'ContactController', 'contact');

                // Subscribe
                resourceAdmin('subscribe', 'SubscribeController', 'subscribe');

                // Page
                resourceAdmin('themes', 'ThemeController', 'theme');

                Route::post('subscribe-status', 'SubscribeController@updateStatus')->name('subscribe.status');

                Route::get('pages/create/load-block', 'PageController@loadBlock')->name("admin.page.load.block")->middleware("permission:admin.page.create", 'permission:admin.page.edit');

                resourceAdmin('pages', 'PageController', 'page');

                resourceAdmin('users', 'UserController', 'user');

                resourceAdmin('roles', 'RoleController', 'role');

                resourceAdmin('system', 'SystemController', 'system', 'system', ['show', 'index', 'create', 'destroy']);
            });
        });
    });
