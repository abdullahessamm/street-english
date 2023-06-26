<?php

namespace App\Http\Controllers\Api\Admins\Courses\IeltsCourses;

use App\Http\Controllers\Api\Admins\Courses\CategoryController;
use App\Models\IETLSCourses\IETLSCourse;
use App\Models\IETLSCourses\IETLSCourseCategory;
use Illuminate\Foundation\Auth\User;

class IeltsCoursesCategoryController extends CategoryController
{
    public function __construct()
    {
        $this->categoryModel = new IETLSCourseCategory();
        $this->policyModel = new IETLSCourse();
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
