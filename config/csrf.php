<?php

return [
    'cookie' => [
        'secure' => env('CSRF_COOKIE_SECURE', true),
        'same_site' => env('CSRF_COOKIE_SAME_SITE', 'none'),
    ],
];
