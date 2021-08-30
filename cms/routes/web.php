<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    Route::post('contact', 'ContactController@postContact')->name('contact.post');
    Route::get('tin-tuc/{slug}', 'NewsController@getNewsDetail')->name('news.detail');
    Route::get('san-pham/{slug}', 'ProductController@getProductDetail')->name('product.detail');
    Route::get('{slug}', 'PageController@show')->name('page.show')->where('slug', '(.*)?');
});

Route::get('remove-cache', function() {
    removeAllConfig();
    echo 'removed all caching';
});
