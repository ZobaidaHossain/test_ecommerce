<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminUserMiddleware;
return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        using: function () {
            // Frontend routes
            Route::middleware('web')
                ->as('frontend.')
                ->group(base_path('routes/frontend.php'));

            // Backend routes
            Route::middleware('web')
                ->prefix('backend')
                ->as('backend.')
                ->group(base_path('routes/backend.php'));
                  Route::group([], base_path('routes/amarpay.php'));

        },
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [
            \App\Http\Middleware\HandleInertiaRequests::class,
            \Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets::class,

        ]);

        $middleware->alias([
            'useradmin'=>AdminUserMiddleware::class,
        ]);


        //
    })
    ->withExceptions(function (Exceptions $exceptions) {

    })->create();
