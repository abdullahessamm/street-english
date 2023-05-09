<?php

namespace App\Http\Controllers\Pages\IETLSCourses\Categories;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IETLSCourseCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('pages.ietls-courses.categories.index');
    }
}
