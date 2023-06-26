<?php

namespace App\Http\Controllers\Api\Admins\Courses\RecordedCourses;

use Illuminate\Foundation\Auth\User;
use App\Models\Courses\CourseCategory;
use App\Http\Controllers\Api\Admins\Courses\CategoryController;
use App\Models\Courses\Course;

class RecordedCoursesCategoryController extends CategoryController
{
    
    public function __construct()
    {
        $this->categoryModel = new CourseCategory();
        $this->policyModel = new Course();
    }
    
    /**
     *
     * @return User
     */
    public function getUser(): User
    {
        return auth('sanctum')->user();
    }
}
