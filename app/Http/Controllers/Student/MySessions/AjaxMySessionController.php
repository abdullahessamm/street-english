<?php

namespace App\Http\Controllers\Student\MySessions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AjaxMySessionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
}
