<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Vega Cms Configuration
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | Site locales
    |--------------------------------------------------------------------------
    |
    | Add here your active locale codes
    | If you don't use URL localization add an empty string as element in the array
    |
    */
    'locales' => [
        'codes' => ['en', 'bg'],
    ],

    /*
    |--------------------------------------------------------------------------
    | Controller namespace
    |--------------------------------------------------------------------------
    |
    | If you are using specific controller namespace, set it in the .env file
    |
    */
    'controllers_namespace' => env('VEGA_CMS_CONTROLLERS_NAMESPACE', ''),
];
