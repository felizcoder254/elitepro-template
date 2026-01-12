<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Force HTTPS in production (CRITICAL FOR RENDER)
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }
        
        // Fix for MySQL/MariaDB index length issues (optional but recommended)
        Schema::defaultStringLength(191);
        
        // If you have time columns, uncomment this:
        // Schema::defaultMorphKeyType('ulid');
    }
}
