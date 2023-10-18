<?php

namespace App\Http\Controllers\Web\Pages\Courses\ZoomLiveCourses;

use App\Http\Controllers\Web\Controller;
use App\Models\ZoomCourses\ZoomCourse;

class ZoomLiveCourseController extends Controller
{
    public function index()
    {
        $zoomCourses = ZoomCourse::orderBy('created_at', 'DESC')->get();

        return view('web.pages.course.zoom.index')->with('zoomCourses', $zoomCourses);
    }

    public function show($slug)
    {
        $zoomCourse = ZoomCourse::where('slug', $slug)->first();
        return view('web.pages.course.zoom.show')->with('zoomCourse', $zoomCourse);
    }
}
