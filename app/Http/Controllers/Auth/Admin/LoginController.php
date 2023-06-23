<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Auth\AbstractLoginController;

class LoginController extends AbstractLoginController
{

    protected string $loginRedirectRoute = 'admin.home';
    protected string $logoutRedirectRoute = 'admin.login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:web:admins,admin.home')->except('logout');
        $this->guard = auth()->guard('web:admins');
    }
}
