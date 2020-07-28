<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Use command line to crate routes.
|
*/

foreach(config('cms.locales.codes', []) as $code) {
    Route::prefix($code)
        ->middleware(['locale', 'bindings'])
        ->namespace('\Vegacms\Cms\Http\Controllers')
        ->group(function () {
            Route::fallback(function ($url) {
                return resolve(\Vegacms\Cms\Http\Controllers\Front\PageController::class)->page('/' . $url);
            });
        });
}
