<?php

namespace App\Policies\Exams\Zoom;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Policies\Traits\Instructors\Exams\Zoom\ZoomCourseSessionStudentExercises as InstructorRules;

class ZoomCourseSessionStudentExercisePolicy
{
    use HandlesAuthorization, InstructorRules;
}
