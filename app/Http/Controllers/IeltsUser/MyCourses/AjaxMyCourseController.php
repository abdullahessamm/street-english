<?php

namespace App\Http\Controllers\Student\MyCourses;

use App\Http\Controllers\Controller;
use App\Models\Courses\Course;
use Illuminate\Http\Request;
use App\Models\Courses\CourseLesson;
use App\Models\Courses\CourseLessonTrack;

class AjaxMyCourseController extends Controller
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

    public function startCourse(Request $request)
    {
        dd($request->input());
    }

    public function nextLesson(Request $request)
    {
        $course_id = $request->input('course_id');
        $user_id = $request->input('user_id');
        $next_lesson_slug = $request->input('next_lesson_slug');

        $course = Course::where('id', $course_id)->first();
        $lesson = CourseLesson::where('slug', $next_lesson_slug)->first();

        CourseLessonTrack::firstOrCreate([
            'course_id' => $course_id,
            'user_id' => $user_id,
            'course_lesson_id' => $lesson->id,
        ],[
            'course_id' => $course_id,
            'user_id' => $user_id,
            'course_lesson_id' => $lesson->id,
            'status' => 'started',
        ]);

        $this->redierctTo('student/my-course/'.$course->slug.'/lesson/'.$next_lesson_slug);
    }

    public function finishLesson(Request $request)
    {
        $course_id = $request->input('course_id');
        $course_lesson_id = $request->input('lesson_id');
        $user_id = $request->input('user_id');

        CourseLessonTrack::where('course_id', $course_id)
        ->where('course_lesson_id', $course_lesson_id)
        ->where('user_id', $user_id)
        ->update([
            'status' => 'finished'
        ]);

        $this->reloadPage();
    }

    public function displayLesson(Request $request)
    {
        $lesson_id = $request->input('lesson_id');
        
        $lesson = CourseLesson::where('id', $lesson_id)->first();

        switch ($lesson->type)
        {
            case 'video':
                return view('student.pages.my-course.preview-lesson.video')->with('lesson', $lesson);
            break;

            case 'audio':
                return view('student.pages.my-course.preview-lesson.audio')->with('lesson', $lesson);
            break;

            case 'doc':
                return view('student.pages.my-course.preview-lesson.doc')->with('lesson', $lesson);
            break;
            
            case 'context':
                return view('student.pages.my-course.preview-lesson.context')->with('lesson', $lesson);
            break;

            case 'frame':
                return view('student.pages.my-course.preview-lesson.iframe')->with('lesson', $lesson);
            break;
        }
    }

    
}
