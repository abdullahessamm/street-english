<?php

namespace App\Http\Controllers\Student\MyCourses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Courses\Course;
use App\Models\Courses\CourseLesson;
use App\Models\EnrolledStudents\EnrolledStudentForCourse;
use App\Http\Controllers\Student\MyCourses\AjaxMyCourseController;
use App\Models\Courses\CourseLessonTrack;
use App\Models\Courses\CourseTrack;

class MyCourseController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user_id = Auth::user()->id;

        $myCourses = EnrolledStudentForCourse::where('user_id', $user_id)->get();
        
        return view('student.pages.my-course.index')->with('myCourses', $myCourses);
    }

    public function show($slug)
    {
        $user_id = Auth::user()->id;

        $myCourse = Course::where('slug', $slug)->first();

        // $countCourseLessonTrack = CourseLessonTrack::where('user_id', $user_id)->where('course_id', $myCourse->id)->count();
        // $getLastCourseLesson = CourseLessonTrack::where('course_id', $myCourse->id)->where('status', 'started')->orderBy('created_at', 'desc')->first();
        $getFirstCourseLesson = $myCourse->lessons->first();

        EnrolledStudentForCourse::where('user_id', $user_id)->where('course_id', $myCourse->id)->where('suspend', 0)->first() == null ? $this->redierctTo('student/my-course/'.$myCourse->slug.'/suspend') : true;

        $getAllCourseLessons = $myCourse->lessons->count();
        // $getFinishedLessons  = CourseLessonTrack::where('course_id', $myCourse->id)->where('status', 'finished')->count();
        
        // $percentage = $getFinishedLessons * 100 / $getAllCourseLessons;

        return view('student.pages.my-course.show')
        ->with('myCourse', $myCourse);
        // ->with('getFirstCourseLesson', $getFirstCourseLesson)
        // ->with('getLastCourseLesson', $getLastCourseLesson)
        // ->with('countCourseLessonTrack', $countCourseLessonTrack)
        // ->with('percentage', $percentage);
    }

    public function lesson($my_course_slug, $lesson_slug)
    {
        $myCourse = Course::where('slug', $my_course_slug)->first();

        $user_id = Auth::user()->id;

        EnrolledStudentForCourse::where('user_id', $user_id)->where('course_id', $myCourse->id)->where('suspend', 0)->first() == null ? $this->redierctTo('student/my-course/'.$myCourse->slug.'/suspend') : true;
        
        $lesson = CourseLesson::where('slug', $lesson_slug)->first();

        // $lesson->track($myCourse->id) == null ? abort(404) : null;

        return view('student.pages.my-course.lesson')
        ->with('myCourse', $myCourse)
        ->with('lesson', $lesson);
    }

    public function suspend($slug)
    {
        $myCourse = Course::where('slug', $slug)->first();

        EnrolledStudentForCourse::where('user_id', Auth::user()->id)->where('course_id', $myCourse->id)->where('suspend', 0)->first() != null ? $this->redierctTo('student/my-course/'.$myCourse->slug.'') : true;

        return view('student.pages.my-course.suspend')->with('myCourse', $myCourse);
    }
}
