<?php

namespace App\Http\Middleware\Api;

use App\Admin;
use Illuminate\Foundation\Auth\User;

class EnsureAuthUserIsAdmin extends EnsureUserType
{

    /**
     * @inheritDoc
     */
    protected function getAuthModel(): User
    {
        return new Admin();
    }
}
