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
    Route::get('{slug}', 'PageController@show')->name('page.show')->where('slug', '(.*)?');
});

Route::get('remove-cache', function() {
    removeAllConfig();
    echo 'removed all caching';
});
