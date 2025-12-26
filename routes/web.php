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
