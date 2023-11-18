<?php

namespace App\Policies\Traits\Instructors\Courses;

use App\Models\Coaches\Coach;
use App\Models\ZoomCourses\ZoomCourse;

trait ZoomCourses
{

    /**
     * Determine whether the user can view the model.
     *
     * @param  Coach  $instructor
     * @param  ZoomCourse  $zoomCourse
     * @return bool
     */
    public function instructorView(Coach $instructor, ZoomCourse $zoomCourse): bool
    {
        // check if instructor has groups
        $hasGroupForInstructor = $zoomCourse->levels()->whereHas('groups', function ($q) use ($instructor) {
            $q->where('instructor_id', $instructor->id);
        })->count() > 0;
        // check if instructor has privates
        $hasPrivateForInstructor = $zoomCourse->levels()->whereHas('privates', function ($q) use ($instructor) {
            $q->where('instructor_id', $instructor->id);
        })->count() > 0;

        return $hasGroupForInstructor || $hasPrivateForInstructor;
    }
}
