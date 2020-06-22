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
    ->middleware(['locale', 'bindings'])
    ->namespace('\Vegacms\Cms\Http\Controllers')
    ->group(function () {
        Route::fallback(function ($url) {
            return resolve(\Vegacms\Cms\Http\Controllers\Front\PageController::class)->page('/' . $url);
        });
    });
