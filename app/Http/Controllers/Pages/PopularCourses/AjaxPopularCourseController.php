<?php

namespace App\Http\Controllers\Pages\PopularCourses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Courses\PopularCourse;

class AjaxPopularCourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $popularCourse = PopularCourse::query();

        return Datatables::of($popularCourse)
        ->editColumn('name', function ($popularCourse) {
            return '<a href="'.route('course.show', [$popularCourse->belongsToCourse->slug]).'">'.$popularCourse->belongsToCourse->name.'</a>';
        })
        ->editColumn('delete', function ($popularCourse) {
            return '<button class="btn btn-danger font-weight-bold removeCourse" data-course-id="'.$popularCourse->id.'">Remove this Course</button>';
        })
        ->rawColumns(['name', 'delete'])
        ->make(true);
    }

    public function addPopularCourse(Request $request)
    {
        $courses = $request->input('courses');

        for($i = 0; $i < count($courses); $i++)
        {
            PopularCourse::firstOrCreate(['course_id' => $courses[$i]], [
                'course_id' => $courses[$i]
            ]);
        }

        $this->successMsg(count($courses) == 1 ? "New course has been added to popular courses" : "New courses has been added to popular courses");

        $this->reloadPage();
    }

    public function remove(Request $request)
    {
        $course_id = $request->input('course_id');

        if(PopularCourse::where('id', $course_id)->delete())
        {
            $this->successMsg("This course has been removed from the popular courses");
            $this->reloadPage();
        }
    }
}
