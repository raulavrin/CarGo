<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Exclude subscription callback routes from CSRF verification
        $middleware->validateCsrfTokens(except: [
            'subscription/success',
            'subscription/fail',
            'subscription/cancel',
            '/subscription/success',
            '/subscription/fail',
            '/subscription/cancel',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();