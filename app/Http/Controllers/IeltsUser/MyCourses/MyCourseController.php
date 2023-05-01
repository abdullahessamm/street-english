<?php

namespace App\Http\Controllers\IeltsUser\MyCourses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\IETLSCourses\IETLSCourse;
use App\Models\IETLSCourses\IETLSCourseLesson;
use App\Models\EnrolledStudents\EnrolledStudentForIETLSCourse;
use App\Http\Controllers\Student\MyCourses\AjaxMyCourseController;
use App\Models\IETLSCourses\IETLSCourseLessonTrack;
use App\Models\IETLSCourses\IETLSCourseTrack;

class MyCourseController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('ielts_user.auth:ielts_user');
    }

    public function index()
    {
        $user_id = Auth::guard('ietls-user')->user()->id;


        $myCourses = EnrolledStudentForIETLSCourse::where('ietls_user_id', $user_id)->get();
        
        return view('ielts-user.pages.my-course.index')->with('myCourses', $myCourses);
    }

    public function show($slug)
    {
        $user_id = Auth::guard('ielts_user')->user()->id;

        $myCourse = IETLSCourse::where('slug', $slug)->first();
        $countCourseLessonTrack = CourseLessonTrack::where('ietls_user_id', $user_id)->where('Ietls_course_id', $myCourse->id)->count();
        $getLastCourseLesson = CourseLessonTrack::where('Ietls_course_id', $myCourse->id)->where('status', 'started')->orderBy('created_at', 'desc')->first();
        $getFirstCourseLesson = $myCourse->lessons->first();

        EnrolledStudentForIETLSCourse::where('user_id', $user_id)->where('Ietls_course_id', $myCourse->id)->where('suspend', 0)->first() == null ? $this->redierctTo('student/my-course/'.$myCourse->slug.'/suspend') : true;

        $getAllCourseLessons = $myCourse->lessons->count();
        $getFinishedLessons  = CourseLessonTrack::where('Ietls_course_id', $myCourse->id)->where('status', 'finished')->count();
        
        $percentage = $getFinishedLessons * 100 / $getAllCourseLessons;

        return view('ielts-user.pages.my-course.show')
        ->with('myCourse', $myCourse)
        ->with('getFirstCourseLesson', $getFirstCourseLesson)
        ->with('getLastCourseLesson', $getLastCourseLesson)
        ->with('countCourseLessonTrack', $countCourseLessonTrack)
        ->with('percentage', $percentage);
    }

    public function lesson($my_course_slug, $lesson_slug)
    {
        $myCourse = IETLSCourse::where('slug', $my_course_slug)->first();

        $user_id = Auth::guard('ielts_user')->user()->id;

        EnrolledStudentForIETLSCourse::where('ielts_user_id', $user_id)->where('Ietls_course_id', $myCourse->id)->where('suspend', 0)->first() == null ? $this->redierctTo('student/my-course/'.$myCourse->slug.'/suspend') : true;
        
        $lesson = IETLSCourseLesson::where('slug', $lesson_slug)->first();

        // $lesson->track($myCourse->id) == null ? abort(404) : null;

        return view('ielts-user.pages.my-course.lesson')
        ->with('myCourse', $myCourse)
        ->with('lesson', $lesson);
    }

    public function suspend($slug)
    {
        $myCourse = IETLSCourse::where('slug', $slug)->first();

        EnrolledStudentForIETLSCourse::where('ietls_user_id', Auth::user()->id)->where('Ietls_course_id', $myCourse->id)->where('suspend', 0)->first() != null ? $this->redierctTo('student/my-course/'.$myCourse->slug.'') : true;

        return view('ielts-user.pages.my-course.suspend')->with('myCourse', $myCourse);
    }
}
