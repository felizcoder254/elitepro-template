<?php

use Illuminate\Support\Facades\Route;

Route::get('/debug-419', function () {
    // Start fresh session
    session()->flush();
    session()->start();
    
    return response()->json([
        // Session state
        'session_id' => session()->getId(),
        'session_started' => session()->isStarted() ? 'YES' : 'NO',
        'session_driver' => config('session.driver'),
        
        // HTTPS detection
        'is_secure' => request()->secure() ? 'YES' : 'NO',
        'scheme' => request()->getScheme(),
        'full_url' => request()->fullUrl(),
        'x_forwarded_proto' => request()->header('x-forwarded-proto'),
        
        // Cookie analysis
        'cookies_received' => request()->cookie(),
        'has_laravel_session' => request()->hasCookie(config('session.cookie')),
        
        // CSRF state
        'csrf_token' => csrf_token(),
        'csrf_in_session' => session()->get('_token'),
        'csrf_match' => csrf_token() === session()->get('_token') ? 'YES' : 'NO',
        
        // Config check
        'app_url' => config('app.url'),
        'app_env' => config('app.env'),
        'app_debug' => config('app.debug'),
        'session_secure' => config('session.secure') ? 'YES' : 'NO',
        'session_http_only' => config('session.http_only') ? 'YES' : 'NO',
        'session_same_site' => config('session.same_site'),
        
        // Server variables
        'server_https' => $_SERVER['HTTPS'] ?? 'not set',
        'server_port' => $_SERVER['SERVER_PORT'] ?? 'not set',
        'all_server_vars' => array_filter($_SERVER, function($key) {
            return in_array($key, ['HTTPS', 'SERVER_PORT', 'HTTP_X_FORWARDED_PROTO', 'HTTP_X_FORWARDED_FOR']);
        }, ARRAY_FILTER_USE_KEY),
    ]);
});

Route::post('/test-post', function () {
    return response()->json([
        'success' => true,
        'message' => 'POST request succeeded',
        'input' => request()->all(),
        'csrf_verified' => 'YES (CSRF is disabled)',
    ]);
});
