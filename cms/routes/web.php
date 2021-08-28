<?php

use Illuminate\Support\Facades\Route;

Route::get('remove-cache', function(){
    removeAllConfig();
    echo 'removed all caching';
});
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [
            'localizationRedirect',
            'web'
        ]
    ],
    function () {
    Route::group([
        'as' => 'frontend.',

    ], function() {
        Auth::routes();
    });

    Route::get('/', 'PageController@index')->name('page.home');

    Route::get('login', function(){
        return redirect()->route('page.home');
    })->name('frontend.login');

    Route::post('reload-favorite', 'ProjectController@getReloadFavorite')->name('get.favorite');

    Route::post('add-favorite', 'ProjectController@addFavoriteProject')->name('add.favorite');

    Route::post('contact', 'ContactController@postContact')->name('contact.post');

    Route::post('type-info', 'ProjectController@getTypeInfo')->name('type.info.post');

    Route::post('project-detail-info', 'ProjectController@getProjectDetailInfo')->name('project.detail.info.post');

    Route::post('project-load-more', 'ProjectController@getProjectLoadMore')->name('project.load.more');

    Route::post('project-investor-load-more', 'ProjectController@getProjectInvestorLoadMore')->name('project.investor.load.more');

    Route::post('project-below-load-more', 'ProjectController@getProjectBelowLoadMore')->name('project.below.load.more');

    Route::post('project-freehold-load-more', 'ProjectController@getProjectFreeHoldLoadMore')->name('project.freehold.load.more');

    Route::post('project-heavily-load-more', 'ProjectController@getProjectHeavilyLoadMore')->name('project.heavily.load.more');

    Route::post('project-lastest-load-more', 'ProjectController@getProjectLastestLoadMore')->name('project.lastest.load.more');

    Route::post('project-near-load-more', 'ProjectController@getProjectNearMRTLoadMore')->name('project.near.load.more');

    Route::post('subscribe', 'ContactController@postSubscribe')->name('subscribe.post');

    Route::get('unsubscribe', 'ContactController@getUnsubscribe')->name('unsubscribe.get');

    Route::get('resubscribe', 'ContactController@getResubscribe')->name('resubscribe.get');

    Route::post('schedule-showflat', 'ContactController@scheduleShowflat')->name('schedule.showflat.post');

    Route::get('logout', 'CustomerController@logoutCustomer')->name('frontend.customer.logout.post');

    Route::get(LaravelLocalization::transRoute('routes.search-index'), 'ProjectController@getSearchIndex')->name('search.index');

    Route::get('search-index-detail', 'ProjectController@getSearchIndexDetail')->name('search.index.detail');

    Route::get(LaravelLocalization::transRoute('routes.guides'), 'GuidesController@getGuidesDetail')->name('frontend.guides.detail');

    Route::get(LaravelLocalization::transRoute('routes.news'), 'NewsController@getNewsDetail')->name('frontend.news.detail');

    Route::get(LaravelLocalization::transRoute('routes.project-detail'), 'ProjectController@getProjectDetail')->name('frontend.project.detail');

    Route::get('report/{link}', 'ProjectController@getLinkReport')->name('frontend.link.report');

    Route::get('{slug}', 'PageController@show')->name('page.show')->where('slug', '(.*)?');

});
