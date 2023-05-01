<?php

namespace App\Http\Controllers\Student\MyExams;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MyExamController extends Controller
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

    public function index()
    {
        return view('student.pages.my-exam.index');
    }
}
