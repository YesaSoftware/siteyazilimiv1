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
       $middleware->validateCsrfTokens(
              except: ['/admin/members/api/insert']
       );

        $middleware->alias([
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
            'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
            'role.or.permission' => \App\Http\Middleware\RoleOrPermissionMiddleware::class,
            'permission_control' => \App\Http\Middleware\PermissionControlMiddleware::class,
            'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
            'setLocale' => \App\Http\Middleware\SetLocale::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
