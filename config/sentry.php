<?php

return [

    'dsn' => env('SENTRY_DSN_PHP'),

    // capture release as git sha
    'release' => env('APP_VERSION'),

    'breadcrumbs' => [
        // Capture Laravel logs in breadcrumbs
        'logs' => true,

        // Capture SQL queries in breadcrumbs
        'sql_queries' => true,

        // Capture bindings on SQL queries logged in breadcrumbs
        'sql_bindings' => true,

        // Capture queue job information in breadcrumbs
        'queue_info' => true,
    ],

    'environment' => env('APP_ENV'),

];
