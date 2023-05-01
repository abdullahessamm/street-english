<?php

namespace App\Http\Controllers\Pages\Courses\ZoomLiveCourses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ZoomCourses\ZoomCourse;

class ZoomLiveCourseController extends Controller
{
    public function index()
    {
        $zoomCourses = ZoomCourse::get();

        return view('pages.course.zoom.index')->with('zoomCourses', $zoomCourses);
    }

    public function show($slug)
    {
        $zoomCourse = ZoomCourse::where('slug', $slug)->first();

        return view('pages.course.zoom.show')->with('zoomCourse', $zoomCourse);
    }
}
