<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

    'paths' => ['api/*'],

    'allowed_methods' => ['GET', 'POST', 'PUT', 'DELETE'],

    'allowed_origins' => [env('FRONTEND_URL')],

    'allowed_origins_patterns' => ['/(.*)\.wip','/(.*)\.test/'],

    'allowed_headers' => ['content-type', 'accept', 'x-custom-header','Authorization'],

    'exposed_headers' => ['x-custom-response-header'],

    'max_age' => 0,

    'supports_credentials' => false,

];
