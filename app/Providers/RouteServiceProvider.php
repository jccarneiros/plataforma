<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const DASHBOARD = '/dashboard';
    public const STUDENT = '/dashboard/students';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/administrations.php'));

            Route::middleware('web')
                ->group(base_path('routes/dashboard.php'));

            Route::middleware('web')
                ->group(base_path('routes/painel.php'));

            Route::middleware('web')
                ->group(base_path('routes/relatorio.php'));

            Route::middleware('web')
                ->group(base_path('routes/document.php'));

            Route::middleware('web')
                ->group(base_path('routes/supervisions.php'));

            Route::middleware('web')
                ->group(base_path('routes/managements.php'));

            Route::middleware('web')
                ->group(base_path('routes/coordenadores.php'));

            Route::middleware('web')
                ->group(base_path('routes/secretaries.php'));

            Route::middleware('web')
                ->group(base_path('routes/teachers.php'));

            Route::middleware('web')
                ->group(base_path('routes/students.php'));

            Route::middleware('web')
                ->group(base_path('routes/components.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }
}
