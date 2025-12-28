<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


// Put this at the VERY TOP of routes/web.php
Route::get('/test', function () {
    return response()->json([
        'status' => 'ok',
        'time' => now()->toDateTimeString(),
        'php' => phpversion(),
        'laravel' => app()->version()
    ]);
});

Route::get('/env-check', function () {
    return response()->json([
        'app_key_set' => !empty(config('app.key')),
        'app_key' => config('app.key') ? substr(config('app.key'), 0, 20) . '...' : 'missing',
        'app_env' => config('app.env'),
        'app_debug' => config('app.debug'),
        'db_connection' => config('database.default'),
    ]);
});
// Your beautiful pages
Route::get('/', function () {
    return view('home');
})->name('home');

// GET routes for login/register pages
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

// Dashboard Route
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// POST routes for form submissions
Route::post('/login', function (Request $request) {
    // Simple authentication logic
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);
    
    // For demo purposes, accept any login and redirect to dashboard
    // In production, you would validate against database
    return redirect()->route('dashboard')->with('success', 'Welcome to your dashboard!');
})->name('login.post');

Route::post('/register', function (Request $request) {
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'password' => 'required|min:8|confirmed',
    ]);
    
    // For demo purposes, redirect to dashboard
    // In production, you would create a user
    return redirect()->route('dashboard')->with('success', 'Account created successfully!');
})->name('register.post');

// Logout route
Route::post('/logout', function () {
    return redirect('/')->with('success', 'Logged out successfully!');
})->name('logout');

// Add the missing password reset route (simple version)
Route::get('/forgot-password', function () {
    return 'Password reset page would go here';
})->name('password.request');

// Optional: Add other auth routes if needed
Route::get('/password/reset', function () {
    return 'Password reset form';
})->name('password.reset');

// Protected routes example (for future use)
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');
    
    Route::get('/settings', function () {
        return view('settings');
    })->name('settings');
});

Route::get('/db-info', function () {
    return response()->json([
        'driver' => config('database.default'),
        'connections' => config('database.connections'),
        'env_db' => env('DB_CONNECTION'),
    ]);
});


Route::get('/debug-csrf-https', function () {
    $token = csrf_token();
    $sessionId = session()->getId();
    
    return response()->json([
        'csrf_token' => $token,
        'session_id' => $sessionId,
        'current_url' => url()->current(),
        'is_secure' => request()->secure(),
        'session_domain' => config('session.domain'),
        'session_secure' => config('session.secure'),
        'session_same_site' => config('session.same_site'),
        'app_url' => config('app.url'),
        'form_example' => '<form method="POST" action="' . route('register') . '">
            <input type="hidden" name="_token" value="' . $token . '">
            <!-- Your form fields -->
        </form>',
    ]);
});

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

Route::get('/debug-session-cookie', function() {
    // Start a session
    session(['test_session_key' => 'test_value']);
    
    // Get the response
    $response = response()->json([
        'session_id' => session()->getId(),
        'session_data' => session()->all(),
        'cookie_in_response' => headers_list() // Check if Set-Cookie header is being sent
    ]);
    
    return $response;
});

Route::get('/debug-session-cookie-plain', function() {
    // Start a session
    session(['test_session_key' => 'test_value']);
    
    // Use a plain response instead of JSON
    return response('Check cookies in DevTools')
        ->header('Content-Type', 'text/plain');
});

Route::get('/debug-middleware', function() {
    $router = app('router');
    
    // Get current route's middleware
    $currentRoute = $router->current();
    $middleware = $currentRoute ? $currentRoute->gatherMiddleware() : [];
    
    // Get all middleware in the web group
    $webMiddleware = app(\App\Http\Kernel::class)->getMiddlewareGroups()['web'] ?? [];
    
    // Check session configuration
    $sessionConfig = [
        'driver' => config('session.driver'),
        'cookie' => config('session.cookie'),
        'domain' => config('session.domain'),
        'secure' => config('session.secure'),
        'same_site' => config('session.same_site'),
    ];
    
    return response()->json([
        'current_route_middleware' => $middleware,
        'web_middleware_group' => $webMiddleware,
        'session_config' => $sessionConfig,
        'session_started' => session()->isStarted(),
        'session_id' => session()->getId(),
    ]);
});

Route::get('/check-error', function() {
    try {
        // Test if Kernel loads
        $kernel = app(\App\Http\Kernel::class);
        return "Kernel loaded successfully. Web middleware count: " . 
               count($kernel->getMiddlewareGroups()['web']);
    } catch (\Exception $e) {
        return "Error: " . $e->getMessage() . "\n\nFile: " . $e->getFile() . 
               "\nLine: " . $e->getLine();
    }
});
Route::get('/simulate-registration', function() {
    // Clear any existing session
    session()->flush();
    
    // Start fresh session
    session()->start();
    
    // Generate CSRF token like a form would
    $token = csrf_token();
    
    // Store in session
    session()->put('_token', $token);
    
    return response()->view('debug-form', [
        'csrf_token' => $token,
        'session_id' => session()->getId()
    ]);
});

Route::get('/cookie-test-force', function() {
    // Force session
    if (!session()->isStarted()) {
        session()->start();
    }
    
    session()->put('test_timestamp', now()->toDateTimeString());
    
    $response = response()->json([
        'message' => 'Cookie should be set',
        'session_id' => session()->getId(),
        'check_devtools' => 'Look for laravel_session cookie in Application → Cookies'
    ]);
    
    // Manually add cookie as backup
    $cookie = cookie(
        'test_manual',
        'manual_cookie_value',
        5,
        '/',
        '.onrender.com',
        true,
        false,
        false,
        'none'
    );
    
    return $response->cookie($cookie);
});

Route::post('/set-emergency-session', function(Request $request) {
    // Accept manual session ID
    $sessionId = $request->input('session_id');
    
    if ($sessionId) {
        // Manually set session
        session()->setId($sessionId);
        session()->start();
        session()->put('emergency_set', true);
        session()->put('emergency_time', now());
        
        return response()->json([
            'status' => 'emergency_session_set',
            'session_id' => $sessionId
        ]);
    }
    
    return response()->json(['error' => 'No session ID'], 400);
});
Route::get('/debug-key', function() {
    try {
        $encrypter = App::make('encrypter');
        return response()->json([
            'status' => 'success',
            'app_key_raw' => env('APP_KEY'),
            'app_key_length' => strlen(env('APP_KEY') ?? ''),
            'app_key_starts_with_base64' => strpos(env('APP_KEY') ?? '', 'base64:') === 0,
            'cipher' => config('app.cipher'),
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => $e->getMessage(),
            'app_key_raw' => env('APP_KEY'),
            'app_key_length' => strlen(env('APP_KEY') ?? ''),
            'app_key_preview' => substr(env('APP_KEY') ?? '', 0, 50),
        ]);
    }
});

// In routes/web.php
Route::get('/session-config', function() {
    return response()->json([
        'session_driver' => config('session.driver'),
        'session_domain' => config('session.domain'),
        'session_secure' => config('session.secure'),
        'session_same_site' => config('session.same_site'),
        'session_path' => config('session.path'),
        'session_http_only' => config('session.http_only'),
        'app_url' => config('app.url'),
        'app_env' => config('app.env'),
        'cookies_encrypted' => config('session.encrypt'),
    ]);
});
Route::get('/test-cookie', function() {
    // Set a test cookie
    $response = response()->json(['message' => 'Cookie test']);
    
    // Set a simple cookie
    $response->cookie('test_cookie', 'test_value', 60, '/', '.onrender.com', true, false);
    
    // Set Laravel session cookie
    session(['test_session' => 'session_value']);
    
    return $response;
});

Route::get('/read-cookie', function() {
    return response()->json([
        'test_cookie' => request()->cookie('test_cookie'),
        'session_test' => session('test_session'),
        'all_cookies' => request()->cookies->all(),
    ]);
});
Route::get('/session-debug', function() {
    // Test if session works
    $count = session('page_visits', 0);
    $count++;
    session(['page_visits' => $count]);
    
    return response()->json([
        'session_working' => session('page_visits') === $count,
        'visits' => $count,
        'session_id' => session()->getId(),
        'laravel_session_cookie' => request()->cookie(session()->getName()),
        'all_cookies' => request()->cookies->all(),
        'session_config' => [
            'driver' => config('session.driver'),
            'secure' => config('session.secure'),
            'same_site' => config('session.same_site'),
            'domain' => config('session.domain'),
        ],
        'request_info' => [
            'secure' => request()->secure(),
            'host' => request()->getHost(),
            'ip' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]
    ]);
});
Route::get('/test-session', function () {
    // Check if we can store and retrieve a session value
    $testValue = session('test_key', 'not_set');
    session(['test_key' => 'test_value']);

    // Check if CSRF token is generated
    $csrfToken = csrf_token();

    // Get session configuration
    $sessionConfig = [
        'driver' => config('session.driver'),
        'domain' => config('session.domain'),
        'secure' => config('session.secure'),
        'same_site' => config('session.same_site'),
        'lifetime' => config('session.lifetime'),
        'expire_on_close' => config('session.expire_on_close'),
    ];

    // Check if session cookie is present in the request
    $hasSessionCookie = request()->hasCookie(config('session.cookie'));

    return response()->json([
        'session_config' => $sessionConfig,
        'csrf_token' => $csrfToken,
        'session_test' => $testValue,
        'session_cookie_name' => config('session.cookie'),
        'has_session_cookie' => $hasSessionCookie,
        'current_session_id' => session()->getId(),
        'request_cookies' => request()->cookie(),
    ]);
});

Route::post('/test-session-post', function () {
    // Check if the CSRF token is valid by using the VerifyCsrfToken middleware
    // We'll just return the session and request data
    return response()->json([
        'message' => 'CSRF token is valid',
        'session_data' => session()->all(),
        'request_cookies' => request()->cookie(),
    ]);
});
Route::get('/fix-session', function() {
    config(['session.domain' => '.onrender.com']);
    config(['session.secure' => true]);
    
    session(['test_fixed' => 'working_' . time()]);
    
    return response()->json([
        'message' => 'Session fixed',
        'session_id' => session()->getId(),
        'test_value' => session('test_fixed'),
        'cookie_domain' => config('session.domain')
    ])->cookie(
        'test_cookie', 
        'test_value', 
        60, 
        '/', 
        '.onrender.com', 
        true, 
        false, 
        false, 
        'lax'
    );
});

Route::get('/check-session', function() {
    return response()->json([
        'has_cookie' => request()->hasCookie('laravel_session'),
        'has_test_cookie' => request()->hasCookie('test_cookie'),
        'all_cookies' => request()->cookie(),
        'session_test' => session('test_fixed', 'not_set')
    ]);
});
Route::get('/debug-cookie', function() {
    $response = response()->json(['message' => 'Cookie set']);
    
    // Set a cookie with the same parameters we think we are setting
    $response->cookie('debug_cookie', 'debug_value', 60, '/', '.onrender.com', true, false, false, 'lax');
    
    // Get the headers that will be sent
    $headers = $response->headers->all();
    
    return response()->json([
        'set_cookie_headers' => $headers['set-cookie'] ?? 'No set-cookie header'
    ]);
});
