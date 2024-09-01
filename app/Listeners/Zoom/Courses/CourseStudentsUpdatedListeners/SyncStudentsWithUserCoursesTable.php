<?php

namespace App\Listeners\Zoom\Courses\CourseStudentsUpdatedListeners;

use App\Events\Zoom\Courses\CourseStudentsUpdated;
use App\Models\ZoomCourses\ZoomCourse;
use App\Models\ZoomCourses\ZoomCourseUser;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SyncStudentsWithUserCoursesTable
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\Zoom\Courses\CourseStudentsUpdated  $event
     * @return void
     */
    public function handle(CourseStudentsUpdated $event)
    {
        $course = $event->getCourse();
        $studentsIds = collect($this->getCourseStudentsIds($course));
        $allSyncedStudents = $course->students()->get(['id']);
        $studentsToBeSynced = $allSyncedStudents->whereIn('id', $studentsIds)
            ->mapWithKeys(fn(ZoomCourseUser $syncedStudent) => [$syncedStudent->id => $syncedStudent->info])
            ->toArray();
        // merge new students
        $studentsIds->filter(
                fn($studentsId) => ! in_array($studentsId, $allSyncedStudents->pluck('id')->toArray())
            )
            ->each(function ($studentsId) use (&$studentsToBeSynced) {
                $studentsToBeSynced[$studentsId] = [
                    'started_at' => now()
                ];
            });
        // sync students
        $course->students()->sync($studentsToBeSynced);
    }

    /**
     * @param ZoomCourse $course
     * @return ZoomCourseUser[] array of course students
     */
    private function getCourseStudentsIds(ZoomCourse $course): array
    {
        $studentsIds = [];
        $course->levels()
            ->with(['groups.students:id', 'privates:zoom_course_level_id,live_course_user_id'])
            ->get(['id'])
            ->each(function ($level) use (&$studentsIds) {
                // groups students
                $level->groups->each(function ($group) use (&$studentsIds) {
                    $studentsIds = array_merge($group->students->pluck('id')->toArray(), $studentsIds);
                });
                // private students
                $studentsIds = array_merge($level->privates->pluck('live_course_user_id')->toArray(), $studentsIds);
            });

        return $studentsIds;
    }
}
