<?php

namespace App\Http\Middleware\Api;

use App\Models\ZoomCourses\ZoomCourseUser;
use Illuminate\Foundation\Auth\User;

class EnsureAuthUserIsZoomStudent extends EnsureUserType
{
    /**
     * @inheritDoc
     */
    protected function getAuthModel(): User
    {
        return new ZoomCourseUser();
    }

}
