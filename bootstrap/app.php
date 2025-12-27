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
