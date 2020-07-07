<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Use command line to crate routes.
|
*/

Route::prefix(app()->getLocale())
    ->middleware(['locale', 'web', 'bindings'])
    ->namespace('\Vegacms\Cms\Http\Controllers')
    ->group(function () {
        Auth::routes();
        if (app()->env === 'testing') {
            Route::get('/test-test', 'Front\TestsController@testTest')->name('test.route');
        }
        Route::get('/welcome', 'Front\WelcomeController@index')->name('welcome');
        Route::get('/home', 'Front\HomeController@index')->name('home')->middleware('ordinaryUsers');
        Route::post('/set-locale', 'Front\LocalesController@setLocale')->name('locales.set-locale');
    });
