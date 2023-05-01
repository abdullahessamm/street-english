<?php

namespace App\Http\Controllers\Pages\Courses\IETLSCourses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\IETLSCourses\IETLSCourse;

class IETLSCourseController extends Controller
{
    public function index(Request $request)
    {
        $courses = IETLSCourse::get();
        
        return view('pages.ietls-course.index')->with('courses', $courses);
    }

    public function show($slug)
    {
        $course = IETLSCourse::where('slug', $slug)->first();

        $course == null ? $this->redierctTo('courses') : true;
        $course->contents->count() == 0 ? abort(404) : true;
        $course->lessons->count() == 0 ? abort(404) : true;

        return view('pages.ietls-course.show')->with('course', $course);
    }
}
