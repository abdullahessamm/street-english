<?php

namespace App\Http\Middleware\Api;

use App\Models\IETLSCourses\IeltsUser;
use Illuminate\Foundation\Auth\User;

class EnsureAuthUserIsIeltsStudent extends EnsureUserType
{

    /**
     * @inheritDoc
     */
    protected function getAuthModel(): User
    {
        return new IeltsUser();
    }
}
