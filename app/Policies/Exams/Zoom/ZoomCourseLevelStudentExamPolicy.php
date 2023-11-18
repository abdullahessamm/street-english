<?php

namespace App\Policies\Exams\Zoom;

use App\Admin;
use App\Policies\Traits\Instructors\Exams\Zoom\ZoomCourseLevelStudentExam;
use Illuminate\Auth\Access\HandlesAuthorization;

class ZoomCourseLevelStudentExamPolicy
{
    use HandlesAuthorization, ZoomCourseLevelStudentExam;

}
