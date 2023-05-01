<?php

namespace App\Http\Controllers\Coach\Pages\MyCourses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\OnlineCourses\OnlineCourseCategory;
use App\Models\OnlineCourses\OnlineCourse;
use App\Models\OnlineCourses\OnlineCourseInstructor;

class MyCourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('coach.auth:coach');
    }

    public function index()
    {
        $onlineCourseInstructor = OnlineCourseInstructor::where('coach_id', Auth::guard('coach')->user()->id)->get();

        return view('coach.pages.my-course.index')->with('onlineCourseInstructor', $onlineCourseInstructor);
    }

    public function show($slug)
    {
        $courseCategories = OnlineCourseCategory::get();
        $myCourse = OnlineCourse::where('slug', $slug)->first();

        $approved = OnlineCourseInstructor::where('coach_id', Auth::guard('coach')->user()->id)->where('online_course_id', $myCourse->id)->first()->approved;

        return view('coach.pages.my-course.show')
        ->with('courseCategories', $courseCategories)
        ->with('myCourse', $myCourse)
        ->with('approved', $approved);
    }

    public function create()
    {
        $courseCategories = OnlineCourseCategory::get();

        return view('coach.pages.my-course.create')->with('courseCategories', $courseCategories);
    }
}
