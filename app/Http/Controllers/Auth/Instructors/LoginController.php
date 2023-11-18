<?php

namespace App\Http\Controllers\Auth\Instructors;

use App\Http\Controllers\Auth\AbstractLoginController;

class LoginController extends AbstractLoginController
{

    protected string $loginRedirectRoute = 'instructor.home';
    protected string $logoutRedirectRoute = 'instructor.login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:web:instructor,instructor.home')->except('logout');
        $this->guard = auth()->guard('web:instructor');
    }
}
