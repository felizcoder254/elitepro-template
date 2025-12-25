<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Detect Render's HTTPS proxy headers
        if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
            $_SERVER['HTTPS'] = 'on';
            $_SERVER['SERVER_PORT'] = 443;
        }
    }

    public function boot(): void
    {
        // Force HTTPS for all generated URLs
        URL::forceScheme('https');
    }
}
