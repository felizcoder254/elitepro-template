<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Force HTTPS detection aggressively
        $_SERVER['HTTPS'] = 'on';
        $_SERVER['SERVER_PORT'] = 443;
        
        // Also set in request
        $this->app['request']->server->set('HTTPS', 'on');
        $this->app['request']->server->set('SERVER_PORT', 443);
    }

    public function boot(): void
    {
        // Always HTTPS, no conditions
        URL::forceScheme('https');
        
        // Force secure session config
        config([
            'session.secure' => true,
            'session.http_only' => true,
            'session.same_site' => 'lax',
        ]);
        
        // Also set cookie secure globally
        if (ini_get('session.cookie_secure') !== '1') {
            ini_set('session.cookie_secure', '1');
        }
    }
}
