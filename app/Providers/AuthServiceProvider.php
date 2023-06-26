<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // users
        \App\Admin::class => \App\Policies\Users\AdminPolicy::class,
        \App\Models\Students\Student::class => \App\Policies\Users\RecordedUserPolicy::class,
        \App\Models\IETLSCourses\IeltsUser::class => \App\Policies\Users\IeltsUserPolicy::class,
        \App\Models\ZoomCourses\ZoomCourseUser::class => \App\Policies\Users\ZoomUserPolicy::class,
        \App\Models\Coaches\Coach::class => \App\Policies\Users\InstructorPolicy::class,
        // courses
        \App\Models\Courses\Course::class => \App\Policies\Courses\RecordedCoursesPolicy::class,
        \App\Models\IETLSCourses\IETLSCourse::class => \App\Policies\Courses\IeltsCoursesPolicy::class,
        \App\Models\ZoomCourses\ZoomCourse::class => \App\Policies\Courses\ZoomCoursesPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
