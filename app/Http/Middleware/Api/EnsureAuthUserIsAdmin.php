<?php

namespace App\Http\Middleware\Api;

use App\Admin;

class EnsureAuthUserIsAdmin extends EnsureUserType
{
    /**
     * user's model class name
     *
     * @var string
     */
    protected string $modelName = Admin::class;
}
