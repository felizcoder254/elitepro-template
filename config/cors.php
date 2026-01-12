<?php

return [
    'paths' => ['api/*', 'sanctum/csrf-cookie', 'login', 'register', 'logout', '*'],
    'allowed_methods' => ['*'],
    'allowed_origins' => ['https://elitepro-template-1.onrender.com'],
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['*'],
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => true,
];
