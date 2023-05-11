<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/student/home';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        $this->mapIeltsUserRoutes();

        $this->mapLiveCourseUserRoutes();

        $this->mapStudentRoutes();

        $this->mapCoachRoutes();

        $this->mapAdminRoutes();

        //
    }

    /**
     * Define the "admin" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapAdminRoutes()
    {
        Route::prefix('admin')
             ->middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/admin.php'));
    }

    /**
     * Define the "student" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapStudentRoutes()
    {
        Route::prefix('student')
             ->middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/student.php'));
    }

    /**
     * Define the "coach" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapCoachRoutes()
    {
        Route::prefix('coach')
             ->middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/coach.php'));
    }

    /**
     * Define the "live_course_user" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapLiveCourseUserRoutes()
    {
        Route::prefix('live-course-user')
             ->middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/live-course-user.php'));
    }

    /**
     * Define the "ielts_user" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapIeltsUserRoutes()
    {
        Route::prefix('ielts-user')
             ->middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/ielts-user.php'));
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }
}
