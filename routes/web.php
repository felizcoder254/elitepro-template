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
