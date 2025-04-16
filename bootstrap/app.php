<?php

use App\Http\Middleware\WebRole;
use App\Http\Middleware\MahasiswaMiddleware;
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
        // Menambahkan alias middleware
        $middleware->alias([
            'role' => WebRole::class,
            'mahasiswa' => MahasiswaMiddleware::class,  // Tambahkan middleware mahasiswa
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Penanganan exception (bisa kamu sesuaikan)
    })
    ->create();
