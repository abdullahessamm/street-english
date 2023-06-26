<?php

namespace App\Http\Controllers\Api\Admins\Users\Students;

use App\Models\ZoomCourses\ZoomCourseUser;

class ZoomCourseStudentsController extends StudentController
{

    protected string $modelClassName = ZoomCourseUser::class;

    public function __construct()
    {
        $this->abilities['index'] = auth('sanctum')->user()->can('index', ZoomCourseUser::class);
        $this->abilities['store'] = auth('sanctum')->user()->can('create', ZoomCourseUser::class);
        $this->abilities['show']  = auth('sanctum')->user()->can('index', ZoomCourseUser::class);
        $this->abilities['update'] = auth('sanctum')->user()->can('update', ZoomCourseUser::class);
        $this->abilities['destroy'] = auth('sanctum')->user()->can('delete', ZoomCourseUser::class);
        $this->abilities['updateProfilePic'] = auth('sanctum')->user()->can('update', ZoomCourseUser::class);
    }
}
