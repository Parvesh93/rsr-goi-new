<?php



namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        

        

        // $this->routes(function(){
        //   Route::middleware('web')->group(base_path('routes/admin.php'));
        //   Route::middleware('web')->group(base_path('routes/vendor.php'));
        // });

    }
}

