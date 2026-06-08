<?php

use App\Http\Middleware\LoadActiveSession;
use App\Http\Middleware\TenantDatabaseMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Spatie\Permission\Middleware\RoleMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        then: function () {

            Route::middleware('web')
                ->group(base_path('routes/school.php'));

            Route::middleware('web')
                ->group(base_path('routes/student.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'role' => RoleMiddleware::class,
            'permission' => PermissionMiddleware::class,
        ]);


        /*
        |--------------------------------------------------------------------------
        | WEB MIDDLEWARE
        |--------------------------------------------------------------------------
        */

        $middleware->web(append: [
            TenantDatabaseMiddleware::class,
            LoadActiveSession::class,
        ]);

        /*
        |--------------------------------------------------------------------------
        | API MIDDLEWARE
        |--------------------------------------------------------------------------
        */

        $middleware->api(append: [
            TenantDatabaseMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();







    // $session = app('active_session'); it can be use any where in this application 