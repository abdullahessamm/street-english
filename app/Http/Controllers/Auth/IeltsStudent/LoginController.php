<?php

namespace App\Http\Controllers\Auth\IeltsStudent;

use App\Http\Controllers\Auth\AbstractLoginController;

class LoginController extends AbstractLoginController
{

    protected string $loginRedirectRoute = 'ieltsStudent.home';
    protected string $logoutRedirectRoute = 'ieltsStudent.login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:web:ieltsStudent,ieltsStudent.home')->except('logout');
        $this->guard = auth()->guard('web:ieltsStudent');
    }
}
