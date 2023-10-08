<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //register models observers
        \App\Admin::observe(\App\Observers\AdminObserver::class);
        \App\Models\ZoomCourses\ZoomCourseSession::observe(\App\Observers\Courses\Zoom\ZoomCourseSessionObServer::class);
        \App\Models\ZoomCourses\ZoomCourseLevelGroup::observe(\App\Observers\Courses\Zoom\ZoomCourseLevelGroupObServer::class);
        \App\Models\ZoomCourses\ZoomCourseLevelPrivate::observe(\App\Observers\Courses\Zoom\ZoomCourseLevelPrivateObServer::class);
    }
}
