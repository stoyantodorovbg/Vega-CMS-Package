<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Use command line to crate routes.
|
*/

foreach(config('cms.locales.codes') as $code) {
    Route::prefix($code)
        ->middleware(['locale', 'web', 'bindings'])
        ->namespace('\Vegacms\Cms\Http\Controllers')
        ->group(function () {
            Auth::routes();
            if (app()->env === 'testing') {
                Route::get('/test-test', 'Front\TestsController@testTest')->name('test.route');
            }
        });
}
