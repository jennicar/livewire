<?php

return [

    'default' => env('FILESYSTEM_LOCAL'),

    'cloud' => env('FILESYSTEM_CLOUD'),

    'disks' => [

        // use this for local storage which should not be publicly available
        // this should be used for things like image caches
        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],

        'public-static' => [
            'driver' => 'local',
            'root' => public_path('static'),
        ],

        's3-public' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'root' => env('AWS_BUCKET_ROOT'),
            'visibility' => 'public',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];
