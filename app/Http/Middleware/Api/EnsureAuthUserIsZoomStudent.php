<?php

namespace App\Http\Middleware\Api;

use App\Models\ZoomCourses\ZoomCourseUser;

class EnsureAuthUserIsZoomStudent extends EnsureUserType
{
    /**
     * user's model class name
     *
     * @var string
     */
    protected string $modelName = ZoomCourseUser::class;
}
