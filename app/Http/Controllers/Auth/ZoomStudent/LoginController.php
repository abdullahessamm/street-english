<?php

namespace App\Http\Controllers\Auth\ZoomStudent;

use App\Http\Controllers\Auth\AbstractLoginController;

class LoginController extends AbstractLoginController
{

    protected string $loginRedirectRoute = 'zoomStudent.home';
    protected string $logoutRedirectRoute = 'zoomStudent.login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:web:zoomStudent,zoomStudent.home')->except('logout');
        $this->guard = auth()->guard('web:zoomStudent');
    }
}
