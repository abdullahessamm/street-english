<?php

namespace App\Http\Middleware\Api;

use App\Models\Coaches\Coach;
use Illuminate\Foundation\Auth\User;

class EnsureAuthUserIsInstructor extends EnsureUserType
{

    /**
     * @inheritDoc
     */
    protected function getAuthModel(): User
    {
        return new Coach();
    }
}
