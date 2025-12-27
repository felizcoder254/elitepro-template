<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Cookie;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // FORCE HTTPS detection
        if ($this->app->environment('production')) {
            if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
                $_SERVER['HTTPS'] = 'on';
            }
            
            // Always set HTTPS in production
            $_SERVER['HTTPS'] = 'on';
            $_SERVER['SERVER_PORT'] = 443;
        }
    }

    public function boot(): void
    {
        // Force HTTPS URLs
        URL::forceScheme('https');
        
        // MANUALLY set cookie parameters - Nuclear option
        if ($this->app->environment('production')) {
            // Override session config
            config([
                'session.secure' => true,
                'session.http_only' => true,
                'session.same_site' => 'lax',
                'session.domain' => 'elitepro-template-1.onrender.com',
            ]);
            
            // Set PHP ini directly
            ini_set('session.cookie_secure', '1');
            ini_set('session.cookie_httponly', '1');
            ini_set('session.cookie_samesite', 'Lax');
            
            // Also set cookie domain via ini
            ini_set('session.cookie_domain', 'elitepro-template-1.onrender.com');
        }
    }
}
