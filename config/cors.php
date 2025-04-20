<?php

return [

    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['*'],

<<<<<<< HEAD
    'allowed_origins' => ['http://localhost:5173', 'http://127.0.0.1:5173', 'http://127.0.0.1:8000', 'http://192.168.0.122:5173', 'http://192.168.0.191:5173'],
=======
    'allowed_origins' => ['*'],
>>>>>>> 75414530434d0b334584a91421549d2005394d2d

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => true,
];
