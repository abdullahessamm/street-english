<?php

namespace App\Http\Controllers\Pages\PopularCourses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Courses\Course;
use App\Models\Courses\PopularCourse;

class PopularCourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $Courses = Course::get();

        $get_popular_courses = PopularCourse::get('course_id')->toArray();

        $get_remain_courses = Course::whereNotIn('id', $get_popular_courses)->get();

        return view('pages.popular-courses.index')->with('get_remain_courses', $get_remain_courses);
    }
}
