<?php

namespace App\Http\Controllers\Pages\Courses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\EnrolledStudents\EnrolledStudentForCourse;
use App\Models\Courses\Course;
use App\Models\Courses\CourseLesson;

class AjaxCourseController extends Controller
{
    public function buyCourse(Request $request)
    {
        $course_id = $request->input('course_id');
        $user_id = $request->input('user_id');
        
        $course = Course::where('id', $course_id)->first();

        EnrolledStudentForCourse::create([
            'course_id' => $course_id,
            'user_id' => $user_id,
        ]);

        $this->successMsg("تم الاشتراك بالدورة");

        $lessons = $course->lessons;
        $firstLesson = $lessons[0];

        $this->redierctTo('student/my-course/'.$course->slug.'/lesson/'.$firstLesson->slug);
    }

    public function loginToBuyCourse(Request $request)
    {
        $course_id = $request->input('course_id');

        $auth = false;
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->has('remember')))
        {
            $auth = true; // Success

            $this->successMsg("تم الدخول الي حسابك");

            $this->reloadPage();
        }
        else
        {
            $this->errorMsg("هذا الحساب لا يوجد");
        }
    }

    public function previewLesson(Request $request)
    {
        $lesson_id = $request->input('lesson_id');

        $lesson = CourseLesson::where('id', $lesson_id)->first();

        return view('pages.course.preview-lesson')->with('lesson', $lesson);
    }
}
