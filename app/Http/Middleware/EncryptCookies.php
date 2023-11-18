<?php

namespace App\Http\Middleware;

use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;

class EncryptCookies extends Middleware
{
    /**
     * The names of the cookies that should not be encrypted.
     *
     * @var array<int, string>
     */
    protected $except = [
        'admin-token',
        'student-token',
        'ieltsuser-token',
        'zoomcourseuser-token',
        'coach-token',
    ];
}
