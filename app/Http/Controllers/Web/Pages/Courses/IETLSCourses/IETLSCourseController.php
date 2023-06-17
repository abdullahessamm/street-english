<?php

namespace App\Http\Controllers\Web\Pages\Courses\IETLSCourses;

use App\Http\Controllers\Web\Controller;
use Illuminate\Http\Request;
use App\Models\IETLSCourses\IETLSCourse;
use App\Models\IETLSCourses\IETLSCourseCategory;

class IETLSCourseController extends Controller
{
    public function index(Request $request)
    {
        $course_category_id = null;

        if($request->query() != null)
        {
            $category_slug = $request->query('category');
            $courseCategory = IETLSCourseCategory::where('slug', $category_slug)->first();

            $course_category_id = $courseCategory->id;
        }

        $coursesCategories = IETLSCourseCategory::get();

        $courses = $request->query() != null ? IETLSCourse::where('ietls_course_category_id', $course_category_id)->get() : IETLSCourse::get();
        
        return view('web.pages.ietls-course.index')
        ->with('coursesCategories', $coursesCategories)
        ->with('courses', $courses);
    }

    public function show($slug)
    {
        $course = IETLSCourse::where('slug', $slug)->first();

        $course == null ? $this->redierctTo('courses') : true;
        $course->isPublished == 0 ? $this->redierctTo('courses') : true;
        $course->contents->count() == 0 ? abort(404) : true;
        $course->lessons->count() == 0 ? abort(404) : true;

        return view('web.pages.ietls-course.show')->with('course', $course);
    }
}
