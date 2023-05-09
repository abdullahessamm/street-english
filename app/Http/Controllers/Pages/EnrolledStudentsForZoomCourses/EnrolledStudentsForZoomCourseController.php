<?php

namespace App\Http\Controllers\Pages\EnrolledStudentsForZoomCourses;

use App\Http\Controllers\Controller;
use App\Models\EnrolledStudents\EnrolledStudentForZoomCourse;
use App\Models\ZoomCourses\ZoomCourse;
use App\Models\ZoomCourses\ZoomCourseUser;
use Illuminate\Http\Request;

class EnrolledStudentsForZoomCourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('pages.enrolled-students-for-zoom-courses.index');
    }

    public function show($slug)
    {
        $ZoomCourse = ZoomCourse::where('slug', $slug)->first();

        if($ZoomCourse == null)
        {
            $this->redierctTo('zoom-courses');
        }
        
        $get_enrolled_students = EnrolledStudentForZoomCourse::where('zoom_course_id', $ZoomCourse->id)->get('live_course_user_id')->toArray();

        $not_registed_students = ZoomCourseUser::whereNotIn('id', $get_enrolled_students)->get();

        return view('pages.enrolled-students-for-zoom-courses.show')
        ->with('not_registed_students', $not_registed_students)
        ->with('ZoomCourse', $ZoomCourse);
    }
}
