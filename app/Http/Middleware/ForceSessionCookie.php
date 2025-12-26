<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ForceSessionCookie
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        
        // ALWAYS set session cookie with Render-compatible settings
        if ($request->hasSession()) {
            $session = $request->session();
            $sessionId = $session->getId();
            
            // Cookie with Render-specific settings
            $cookie = cookie(
                'laravel_session',
                $sessionId,
                120 * 60, // 120 hours in minutes
                '/',
                '.onrender.com', // CRITICAL: leading dot for all subdomains
                true,     // secure
                false,    // httpOnly = false so JavaScript can see it
                false,
                'none'    // SameSite = none for cross-origin on Render
            );
            
            $response->headers->setCookie($cookie);
            
            // Also set a JavaScript-accessible version for debugging
            $jsCookie = cookie(
                'debug_sid',
                $sessionId,
                5, // 5 minutes
                '/',
                '.onrender.com',
                true,
                false, // NOT httpOnly
                false,
                'none'
            );
            
            $response->headers->setCookie($jsCookie);
        }
        
        return $response;
    }
}
