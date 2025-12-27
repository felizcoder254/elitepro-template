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
