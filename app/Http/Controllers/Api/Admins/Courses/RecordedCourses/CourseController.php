<?php

namespace App\Http\Controllers\Api\Admins\Courses\RecordedCourses;

use App\Http\Controllers\Api\Admins\Courses\PreRecordedCoursesController;
use App\Http\Requests\Api\AdminDashboard\Courses\Recorded\StoreRequest;
use App\Models\Courses\Course;
use Illuminate\Database\Eloquent\Model;

class CourseController extends PreRecordedCoursesController
{
    protected function getModel(): Model
    {
        return new Course();
    }

    protected function storeRules(): array
    {
        $request = new StoreRequest();
        return $request->rules();
    }
}
