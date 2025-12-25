<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Force HTTPS for Render
        if (env('APP_ENV') === 'production') {
            $_SERVER['HTTPS'] = 'on';
            $_SERVER['SERVER_PORT'] = 443;
            
            // Set the request to HTTPS
            $this->app['request']->server->set('HTTPS', 'on');
            $this->app['request']->server->set('SERVER_PORT', 443);
        }
    }

    public function boot(): void
    {
        // Always force HTTPS in production
        if (env('APP_ENV') === 'production') {
            URL::forceScheme('https');
            
            // Force secure session cookies
            config([
                'session.secure' => true,
                'session.http_only' => true,
                'session.same_site' => 'lax',
            ]);
        }
    }
}
