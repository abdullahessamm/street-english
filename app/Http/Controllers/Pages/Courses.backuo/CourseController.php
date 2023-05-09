<?php

namespace App\Http\Controllers\Pages\Courses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Courses\Course;
use App\Models\Courses\CourseContent;
use App\Models\Courses\CourseLesson;
use App\Models\Courses\CourseCategory;
use App\Models\Courses\CourseInstructor;
use App\Models\Coaches\Coach;

class CourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('pages.courses.index');
    }

    public function create()
    {
        $coaches = Coach::get();

        $courseCategories = CourseCategory::count() == 0 ? $this->redierctTo('courses/categories') : CourseCategory::get();

        return view('pages.courses.create')
        ->with('courseCategories', $courseCategories)
        ->with('coaches', $coaches);
    }

    public function show($slug)
    {
        $course = Course::where('slug', $slug)->first();
        $coaches = Coach::get();

        if($course == null)
        {
            $this->redierctTo('courses');
        }

        $courseCategories = CourseCategory::get();

        return view('pages.courses.show')
        ->with('course', $course)
        ->with('courseCategories', $courseCategories)
        ->with('coaches', $coaches);
    }

    public function contents($slug)
    {
        $course = Course::where('slug', $slug)->first();

        return view('pages.courses.contents')->with('course', $course);
    }
}
