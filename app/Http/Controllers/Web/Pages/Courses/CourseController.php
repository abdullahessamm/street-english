<?php

namespace App\Http\Controllers\Web\Pages\Courses;

use App\Http\Controllers\Web\Controller;
use Illuminate\Http\Request;
use App\Models\Courses\CourseCategory;
use App\Models\Courses\Course;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $course_category_id = null;

        if($request->query() != null)
        {
            $category_slug = $request->query('category');
            $courseCategory = CourseCategory::where('slug', $category_slug)->first();

            $course_category_id = $courseCategory->id;
        }

        $coursesCategories = CourseCategory::get();

        $courses = $request->query() != null ? Course::where('course_category_id', $course_category_id)->get() : Course::get();
        
        return view('web.pages.course.index')
        ->with('coursesCategories', $coursesCategories)
        ->with('courses', $courses);
    }

    public function show($slug)
    {
        $course = Course::where('slug', $slug)->first();

        $course == null ? $this->redierctTo('courses') : true;
        $course->isPublished == 0 ? $this->redierctTo('courses') : true;
        $course->contents->count() == 0 ? abort(404) : true;
        $course->lessons->count() == 0 ? abort(404) : true;

        return view('web.pages.course.show')->with('course', $course);
    }
}
