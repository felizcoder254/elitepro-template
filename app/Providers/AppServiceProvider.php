<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Force HTTPS detection for Render
        if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
            $_SERVER['HTTPS'] = 'on';
            $_SERVER['SERVER_PORT'] = 443;
        }
    }

    public function boot(): void
    {
        // Always force HTTPS URLs
        URL::forceScheme('https');
        
        // Ensure secure session cookies
        config(['session.secure' => true]);
        config(['session.same_site' => 'lax']);
    }
}
