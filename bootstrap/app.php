<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\PreventDirectAccess;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        channels: __DIR__.'/../routes/channels.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias(['logged_in'=>PreventDirectAccess::class]);
    })
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias(['is_admin'=>PreventDirectAccess::class]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
