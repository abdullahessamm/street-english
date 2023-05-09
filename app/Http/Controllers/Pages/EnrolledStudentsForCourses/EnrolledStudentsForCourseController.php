<?php

namespace App\Http\Controllers\Pages\EnrolledStudentsForCourses;

use App\Http\Controllers\Controller;
use App\Models\Courses\Course;
use App\Models\EnrolledStudents\EnrolledStudentForCourse;
use App\Models\Students\Student;
use Illuminate\Http\Request;

class EnrolledStudentsForCourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('pages.enrolled-students-for-courses.index');
    }

    public function show($slug)
    {
        $Course = Course::where('slug', $slug)->first();

        if($Course == null)
        {
            $this->redierctTo('courses');
        }
        
        $get_enrolled_students = EnrolledStudentForCourse::where('course_id', $Course->id)->get('user_id')->toArray();

        $not_registed_students = Student::whereNotIn('id', $get_enrolled_students)->get();

        return view('pages.enrolled-students-for-courses.show')
        ->with('not_registed_students', $not_registed_students)
        ->with('Course', $Course);
    }
}
