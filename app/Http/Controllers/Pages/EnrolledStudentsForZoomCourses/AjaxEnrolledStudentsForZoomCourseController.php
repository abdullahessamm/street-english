<?php

namespace App\Http\Controllers\Pages\EnrolledStudentsForZoomCourses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\ZoomCourses\ZoomCourse;
use App\Models\EnrolledStudents\EnrolledStudentForZoomCourse;

class AjaxEnrolledStudentsForZoomCourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $ZoomCourse = ZoomCourse::query();

        return Datatables::of($ZoomCourse)
        ->editColumn('title', function ($ZoomCourse) {
            return '<a href="'.route('zoom-course.show', [$ZoomCourse->slug]).'">'.$ZoomCourse->title.'</a>';
        })
        ->editColumn('enrolled_students', function ($ZoomCourse) {
            return '<a href="'.route('enrolled-students-for-zoom-courses.show', [$ZoomCourse->slug]).'">'.$ZoomCourse->enrolledStudents->count().'</a>';
        })
        ->rawColumns(['title', 'enrolled_students'])
        ->make(true);
    }

    public function append(Request $request)
    {
        $zoom_course_id = $request->input('zoom_course_id');
        $students = $request->input('students');
        
        for($i = 0; $i < count($students); $i++)
        {
            EnrolledStudentForZoomCourse::create([
                'zoom_course_id' => $zoom_course_id,
                'live_course_user_id' => $students[$i],
            ]);
        }

        $this->successMsg(count($students) == 1 ? 'New student has been appended to this course' : 'New students has been appended to this course');

        $this->reloadPage();
    }

    public function remove(Request $request)
    {
        $enrolled_student_id = $request->input('enrolled_student_id');

        if(EnrolledStudentForZoomCourse::where('id', $enrolled_student_id)->delete())
        {
            $this->successMsg("This user has been removed from this course");
        }
    }
}
