<?php

use App\Http\Middleware\CheckAdminLogin;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function () {
            Route::middleware('web', CheckAdminLogin::class)
                ->prefix('admin')
                ->name('admin.')
                ->group(base_path('routes/admin/web.php'));
            Route::middleware('web')
                ->prefix('admin/auth')
                ->group(base_path('routes/admin/auth.php'));
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/user/api.php'));
            Route::middleware('api')
                ->prefix('api/auth/user')
                ->group(base_path('routes/user/auth.php'));
        }
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
