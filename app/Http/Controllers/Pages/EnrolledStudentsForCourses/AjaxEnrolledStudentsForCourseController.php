<?php

namespace App\Http\Controllers\Pages\EnrolledStudentsForCourses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Courses\Course;
use App\Models\EnrolledStudents\EnrolledStudentForCourse;

class AjaxEnrolledStudentsForCourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $Course = Course::query();

        return Datatables::of($Course)
        ->editColumn('name', function ($Course) {
            return '<a href="'.route('course.show', [$Course->slug]).'">'.$Course->name.'</a>';
        })
        ->editColumn('enrolled_students', function ($Course) {
            return '<a href="'.route('enrolled-students-for-courses.show', [$Course->slug]).'">'.$Course->enrolledStudents->count().'</a>';
        })
        ->rawColumns(['name', 'enrolled_students'])
        ->make(true);
    }

    public function append(Request $request)
    {
        $Course_id = $request->input('course_id');
        $students = $request->input('students');

        for($i = 0; $i < count($students); $i++)
        {
            EnrolledStudentForCourse::create([
                'course_id' => $Course_id,
                'user_id' => $students[$i],
            ]);
        }

        $this->successMsg(count($students) == 1 ? 'New student has been appended to this course' : 'New students has been appended to this course');

        $this->reloadPage();
    }

    public function suspend(Request $request)
    {
        $student_id = $request->input('data')['student_id'];

        EnrolledStudentForCourse::where('user_id', $student_id)->update([
            'suspend' => 1,
        ]);

        $this->successMsg("This user has been banned from this course");
    }

    public function unSuspend(Request $request)
    {
        $student_id = $request->input('data')['student_id'];

        EnrolledStudentForCourse::where('user_id', $student_id)->update([
            'suspend' => 0,
        ]);

        $this->successMsg("This user can resume the course");
    }

    public function remove(Request $request)
    {
        $enrolled_student_id = $request->input('enrolled_student_id');

        if(EnrolledStudentForCourse::where('id', $enrolled_student_id)->delete())
        {
            $this->successMsg("This user has been removed from this course");
        }
    }
}
