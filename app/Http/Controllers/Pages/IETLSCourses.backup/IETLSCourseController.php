<?php

namespace App\Http\Controllers\Pages\IETLSCourses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\IETLSCourses\IETLSCourse;
use App\Models\IETLSCourses\IETLSCourseContent;
use App\Models\IETLSCourses\IETLSCourseLesson;
use App\Models\IETLSCourses\IETLSCourseCategory;
use App\Models\IETLSCourses\IETLSCourseInstructor;
use App\Models\Coaches\Coach;

class IETLSCourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('pages.ietls-courses.index');
    }

    public function create()
    {
        $coaches = Coach::get();

        return view('pages.ietls-courses.create')->with('coaches', $coaches);
    }

    public function show($slug)
    {
        $course = IETLSCourse::where('slug', $slug)->first();
        $coaches = Coach::get();

        if($course == null)
        {
            $this->redierctTo('ietls-courses');
        }

        return view('pages.ietls-courses.show')
        ->with('course', $course)
        ->with('coaches', $coaches);
    }

    public function contents($slug)
    {
        $course = IETLSCourse::where('slug', $slug)->first();
        return view('pages.ietls-courses.contents')->with('course', $course);
    }
}
