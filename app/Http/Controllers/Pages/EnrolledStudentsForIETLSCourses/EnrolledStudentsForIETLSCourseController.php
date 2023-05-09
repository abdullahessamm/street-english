<?php

namespace App\Http\Controllers\Pages\EnrolledStudentsForIETLSCourses;

use App\Http\Controllers\Controller;
use App\Models\IETLSCourses\IETLSCourse;
use App\Models\EnrolledStudents\EnrolledStudentForIETLSCourse;
use App\Models\IETLSCourses\IeltsUser;
use App\Models\Students\Student;
use Illuminate\Http\Request;

class EnrolledStudentsForIETLSCourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('pages.enrolled-students-for-ietls-courses.index');
    }

    public function show($slug)
    {
        $Course = IETLSCourse::where('slug', $slug)->first();

        if($Course == null)
        {
            $this->redierctTo('courses');
        }
        
        $get_enrolled_students = EnrolledStudentForIETLSCourse::where('Ietls_course_id', $Course->id)->get('ielts_user_id')->toArray();

        $not_registed_students = IeltsUser::whereNotIn('id', $get_enrolled_students)->get();

        return view('pages.enrolled-students-for-ietls-courses.show')
        ->with('not_registed_students', $not_registed_students)
        ->with('Course', $Course);
    }
}
