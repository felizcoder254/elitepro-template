// Create: app/Http/Middleware/FixRenderSession.php
<?php

namespace App\Http\Middleware;

use Closure;

class FixRenderSession
{
    public function handle($request, Closure $next)
    {
        // If running on Render, remove domain from session config
        if (strpos($request->getHost(), 'onrender.com') !== false) {
            config(['session.domain' => null]);
            config(['session.same_site' => 'lax']);
            
            // Force HTTPS
            if (!$request->secure()) {
                return redirect()->secure($request->path());
            }
        }
        
        return $next($request);
    }
}
