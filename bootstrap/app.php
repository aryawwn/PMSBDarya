<?php

use App\Http\Middleware\DBDynamicConnection;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'role' => \App\Http\Middleware\CheckRole::class,
        ]);
    })
        ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(DBDynamicConnection::class); // -> Ini tempat mendaftarkan middleware yang baru kita buat
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();

