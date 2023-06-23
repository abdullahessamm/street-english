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
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            $this->initRoutes();
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }

    /**
     * initialize routes depends on dev machine
     *
     * @return void
     */
    private function initRoutes()
    {
        // production production
        if (config('app.domain') !== 'localhost') {
            Route::domain('api.' . config('app.domain'))
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api/index.php'));

            Route::domain('admin.' . config('app.domain'))
                ->middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));

            Route::domain('ielts.' . config('app.domain'))
                ->middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/ielts.php'));

            Route::domain('zoom.' . config('app.domain'))
                ->middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/zoom.php'));

            Route::domain('recorded.' . config('app.domain'))
                ->middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/recorded.php'));
                
        } 
        // development env
        else {
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api/index.php'));
            
            Route::prefix('admin')
                ->middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/admin.php'));

                Route::prefix('ielts')
                ->middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/ielts.php'));

            Route::prefix('zoom')
                ->middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/zoom.php'));

            Route::prefix('recorded')
                ->middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/recorded.php'));
        }

        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }
}
