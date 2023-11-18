<?php

namespace App\Policies\Courses;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Policies\Traits\Admins\Courses\ZoomCourses as AdminPolicies;
use App\Policies\Traits\Instructors\Courses\ZoomCourses as InstructorPolicies;

class ZoomCoursesPolicy
{
    use HandlesAuthorization, AdminPolicies, InstructorPolicies;

}
