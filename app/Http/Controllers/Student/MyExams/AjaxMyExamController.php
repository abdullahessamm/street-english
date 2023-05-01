<?php

namespace App\Http\Controllers\Student\MyExams;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AjaxMyExamController extends Controller
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
