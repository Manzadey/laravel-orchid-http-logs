<?php

declare(strict_types=1);

return [
    'enabled' => env('HTTP_LOG_ENABLED', true),

    'connection' => env('DB_CONNECTION'),

    'table' => 'http_logs',

    'hide' => [
        'enabled' => env('HTTP_LOG_HIDE_ENABLED', true),

        'keys' => [
            'authorization',
            'token',
            'access_token',
            'password',
            'password_confirmation',
        ],
    ],

    'ignore_routes' => [
        'platform.systems.relation',
    ],

    'allowed_methods' => [
        'POST',
    ],
];
