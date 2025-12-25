<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // FORCE HTTPS for Render
        if ($this->app->environment('production')) {
            $_SERVER['HTTPS'] = 'on';
            $_SERVER['SERVER_PORT'] = 443;
            
            // Also force it in the request
            if (isset($this->app['request'])) {
                $this->app['request']->server->set('HTTPS', 'on');
                $this->app['request']->server->set('SERVER_PORT', 443);
            }
        }
    }

    public function boot(): void
    {
        // Force HTTPS URLs
        URL::forceScheme('https');
        
        // Force secure cookies - ADD SAME_SITE SETTING
        config([
            'session.secure' => true,
            'session.http_only' => true,
            'session.same_site' => 'none', // ← ADD THIS LINE - CRITICAL!
        ]);
    }
}
