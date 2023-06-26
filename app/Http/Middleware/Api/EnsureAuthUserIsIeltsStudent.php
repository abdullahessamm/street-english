<?php

namespace App\Http\Middleware\Api;

use App\Models\IETLSCourses\IeltsUser;

class EnsureAuthUserIsIeltsStudent extends EnsureUserType
{
    /**
     * user's model class name
     *
     * @var string
     */
    protected string $modelName = IeltsUser::class;
}
