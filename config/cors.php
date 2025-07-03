<?php

return [

    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['*'],

    // 'allowed_origins' => ['*'],
    // 'allowed_origins' => ['http://localhost:5173', 'http://127.0.0.1:5173', 'http://127.0.0.1:8000', 'http://192.168.0.115:5173', 'http://192.168.0.191:5173'],
    'allowed_origins' => ['http://localhost:5173', 'http://127.0.0.1:5173', 'http://127.0.0.1:8000', 'http://192.168.0.*:5173'],
    'allowed_origins_patterns' => ['/http:\/\/192\.168\.0\.\d{1,3}:5173/'],

    // 'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => true,
];