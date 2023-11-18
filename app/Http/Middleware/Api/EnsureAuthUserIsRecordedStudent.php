<?php

namespace App\Http\Middleware\Api;

use App\Models\Students\Student;
use Illuminate\Foundation\Auth\User;

class EnsureAuthUserIsRecordedStudent extends EnsureUserType
{

    /**
     * @inheritDoc
     */
    protected function getAuthModel(): User
    {
        return new Student();
    }
}
