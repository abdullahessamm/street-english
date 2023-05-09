<?php

namespace App\Http\Controllers\Pages\InstructorsForCourses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Courses\Course;
use App\Models\Courses\CourseInstructor;
use App\Models\Coaches\Coach;

class InstructorsForCourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('pages.instructors-for-course.index');
    }

    public function show($slug)
    {
        $Course = Course::where('slug', $slug)->first();

        if($Course == null)
        {
            $this->redierctTo('courses');
        }

        $get_instructors_course = CourseInstructor::where('course_id', $Course->id)->get('coach_id')->toArray();
        $not_registed_instructors = Coach::whereNotIn('id', $get_instructors_course)->get();

        return view('pages.instructors-for-course.show')
        ->with('not_registed_instructors', $not_registed_instructors)
        ->with('Course', $Course);
    }
}
