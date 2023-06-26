<?php

namespace App\Http\Middleware\Api;

use App\Models\Students\Student;

class EnsureAuthUserIsRecordedStudent extends EnsureUserType
{
    /**
     * user's model class name
     *
     * @var string
     */
    protected string $modelName = Student::class;
}
