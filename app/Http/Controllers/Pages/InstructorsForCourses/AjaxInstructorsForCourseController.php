<?php

namespace App\Http\Controllers\Pages\InstructorsForCourses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Courses\Course;
use App\Models\Courses\CourseInstructor;

class AjaxInstructorsForCourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $course = Course::query();

        return Datatables::of($course)
        ->editColumn('name', function ($course) {
            return '<a href="'.route('course.show', [$course->slug]).'">'.$course->name.'</a>';
        })
        ->editColumn('instructors', function ($course) {
            return '<a href="'.route('instructors-for-course.show', [$course->slug]).'">'.$course->instructors->count().'</a>';
        })
        ->rawColumns(['name', 'instructors'])
        ->make(true);
    }

    public function append(Request $request)
    {
        $course_id = $request->input('course_id');
        $coaches = $request->input('instructors');

        for($i = 0; $i < count($coaches); $i++)
        {
            CourseInstructor::create([
                'course_id' => $course_id,
                'coach_id' => $coaches[$i],
                'approved' => 1
            ]);
        }

        $this->successMsg(count($coaches) == 1 ? 'New instructor has been appended to this course' : 'New instructors has been appended to this course');

        $this->reloadPage();
    }

    public function suspend(Request $request)
    {
        $coach_id = $request->input('data')['coach_id'];

        CourseInstructor::where('coach_id', $coach_id)->update([
            'suspend' => 1,
        ]);

        $this->successMsg("This instructor has been banned from this course");
    }

    public function unSuspend(Request $request)
    {
        $coach_id = $request->input('data')['coach_id'];

        CourseInstructor::where('coach_id', $coach_id)->update([
            'suspend' => 0,
        ]);

        $this->successMsg("This instructor can resume the course");
    }

    public function remove(Request $request)
    {
        $coach_id = $request->input('coach_id');

        if(CourseInstructor::where('id', $coach_id)->delete())
        {
            $this->successMsg("This instructor has been removed from this course");
        }
    }
}
