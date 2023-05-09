<?php

namespace App\Http\Controllers\Pages\IETLSCourses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Courses\Course;
use App\Models\Courses\CourseContent;
use App\Models\Courses\CourseLesson;
use App\Models\Courses\CourseCategory;
use App\Models\Courses\CourseInstructor;
use App\Models\Coaches\Coach;
use App\Models\IETLSCourses\IETLSCourse;
use App\Models\IETLSCourses\IETLSCourseCategory;
use App\Models\IETLSCourses\IETLSCourseLesson;

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
        $coaches = Coach::count() == 0 ? $this->redierctTo('coach/create') : Coach::get();

        $courseCategories = IETLSCourseCategory::count() == 0 ? $this->redierctTo('ietls-courses/categories') : IETLSCourseCategory::get();

        return view('pages.ietls-courses.create')
        ->with('courseCategories', $courseCategories)
        ->with('coaches', $coaches);
    }

    public function show($slug)
    {
        $course = IETLSCourse::where('slug', $slug)->first();
        $coaches = Coach::get();
        
        if($course == null)
        {
            $this->redierctTo('ietls-courses');
        }

        $courseCategories = IETLSCourseCategory::get();

        return view('pages.ietls-courses.show')
        ->with('course', $course)
        ->with('courseCategories', $courseCategories)
        ->with('coaches', $coaches);
    }

    public function contents($slug)
    {
        $course = IETLSCourse::where('slug', $slug)->first();

        return view('pages.ietls-courses.contents')->with('course', $course);
    }

    public function lesson($course_slug, $content_slug, $lesson_slug)
    {
        $lesson = IETLSCourseLesson::where('slug', $lesson_slug)->first();
        
        $instructors = $lesson->belongsToContent->belongsToCourse->instructors;

        
        if($lesson == null)
        {
            $this->redierctTo('courses');
        }
        
        return view('pages.ietls-courses.lesson')
        ->with('lesson', $lesson)
        ->with('instructors', $instructors);
    }
}
