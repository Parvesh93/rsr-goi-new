<?php
use App\Http\Middleware\LicenseVerification;
use App\Http\Middleware\XSSProtection;
use App\Http\Middleware\RedirectIfAuthenticated;
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
         // This is good method to pass data with middleware 
         $middleware->alias([

            'XSS'=>XSSProtection::class,
            'guest'=>RedirectIfAuthenticated::class,
            // 'license'=>LicenseVerification::class,
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
            'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
            'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
            
            // 'UserViewAuth'=>UserViewAuth::class,
            // 'UserViewUnAuth'=>UserViewUnAuth::class,
            // 'VendorViewAuth'=>VendorViewAuth::class,
            // 'VendorViewUnAuth'=>VendorViewUnAuth::class,
            // 'setlocale'=>SetLocale::class

        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
