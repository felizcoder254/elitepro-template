<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

$_ENV['SESSION_SECURE_COOKIE'] = 'false';
$_ENV['SESSION_SAME_SITE'] = 'none';
$_ENV['SESSION_DOMAIN'] = '.onrender.com';
putenv('SESSION_SECURE_COOKIE=false');
putenv('SESSION_SAME_SITE=none');
putenv('SESSION_DOMAIN=.onrender.com');

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
Route::get('/force-fix', function() {
    // Force the correct config
    config([
        'session.secure' => false,
        'session.same_site' => 'none',
        'session.domain' => '.onrender.com',
    ]);
    
    // Clear session and start fresh
    session()->flush();
    
    // Test
    session(['force_fix_test' => 'working']);
    
    return response()->json([
        'success' => session('force_fix_test') === 'working',
        'config' => [
            'secure' => config('session.secure'),
            'same_site' => config('session.same_site'),
            'domain' => config('session.domain'),
        ],
        'session_id' => session()->getId(),
    ])->cookie('test_cookie', 'test_value', 2);
});

Route::get('/debug-env', function() {
    return response()->json([
        'SESSION_SECURE_COOKIE' => env('SESSION_SECURE_COOKIE'),
        'SESSION_SAME_SITE' => env('SESSION_SAME_SITE'), 
        'SESSION_DOMAIN' => env('SESSION_DOMAIN'),
        'APP_ENV' => env('APP_ENV'),
        'APP_DEBUG' => env('APP_DEBUG'),
        'ALL_ENV' => [
            'SESSION_*' => [
                'secure' => env('SESSION_SECURE_COOKIE'),
                'same_site' => env('SESSION_SAME_SITE'),
                'domain' => env('SESSION_DOMAIN'),
                'driver' => env('SESSION_DRIVER'),
                'lifetime' => env('SESSION_LIFETIME'),
            ]
        ]
    ]);
});

Route::get('/debug-session', function() {
    // Test session
    $count = session('visit_count', 0);
    $count++;
    session(['visit_count' => $count]);
    
    return response()->json([
        'session_working' => session('visit_count') === $count,
        'visits' => $count,
        'session_id' => session()->getId(),
        'laravel_session_cookie' => request()->cookie(session()->getName()),
        'all_cookies' => request()->cookies->all(),
        'config' => [
            'secure' => config('session.secure'),
            'same_site' => config('session.same_site'),
            'domain' => config('session.domain'),
            'driver' => config('session.driver'),
        ],
        'request' => [
            'secure' => request()->secure(),
            'host' => request()->getHost(),
            'full_url' => request()->fullUrl(),
        ]
    ]);
});

Route::get('/clear-cache', function() {
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    
    return "All caches cleared!";
});

Route::get('/force-session-fix', function() {
    // Force correct config
    config([
        'session.secure' => false,
        'session.same_site' => 'none',
        'session.domain' => '.onrender.com',
    ]);
    
    // Start fresh session
    session()->flush();
    
    // Test
    session(['test' => 'working']);
    
    return response()->json([
        'message' => 'Session config forced',
        'test_value' => session('test'),
        'config' => [
            'secure' => config('session.secure'),
            'same_site' => config('session.same_site'),
            'domain' => config('session.domain'),
        ]
    ]);
});

