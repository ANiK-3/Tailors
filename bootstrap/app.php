<?php

use App\Http\Middleware\RoleMiddleware;
use App\Http\Middleware\CheckHireRequestTiming;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: [
            __DIR__ . '/../routes/web/web.php',
            __DIR__ . '/../routes/web/admin.php',
            __DIR__ . '/../routes/web/customer.php',
            __DIR__ . '/../routes/web/tailor.php',
            __DIR__ . '/../routes/web/global.php',
            __DIR__ . '/../routes/web/auth.php',
        ],
        commands: __DIR__ . '/../routes/console.php',
        channels: __DIR__ . '/../routes/channels.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'role' => RoleMiddleware::class,
            'check.hire.timing' => CheckHireRequestTiming::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();