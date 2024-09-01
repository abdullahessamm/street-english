<?php

namespace App\Providers;

use App\Events\Auth\RegisterEvent;
use App\Events\Zoom\Courses\CourseStudentsUpdated as ZoomCourseStudentsUpdated;
use App\Listeners\Auth\RegisterEventListeners\SendVerificationMail;
use App\Listeners\Zoom\Courses\CourseStudentsUpdatedListeners\SyncStudentsWithUserCoursesTable;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        RegisterEvent::class => [
            SendVerificationMail::class
        ],
        ZoomCourseStudentsUpdated::class => [
            SyncStudentsWithUserCoursesTable::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
