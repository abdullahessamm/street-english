<?php

namespace App\Http\Controllers\Pages\ZoomCourses;

use App\Http\Controllers\Controller;
use App\Models\Exams\Exam;
use App\Models\Excercises\ExerciseAnswer;
use App\Models\Exercises\Exercise;
use App\Models\Exercises\ExerciseUser;
use App\Models\SurveyJs\SurveyJs;
use App\Models\ZoomCourses\ZoomCourse;
use App\Models\ZoomCourses\ZoomCourseLevel;
use App\Models\ZoomCourses\ZoomCourseSession;
use Illuminate\Http\Request;

class ZoomCourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        return view('pages.zoom-courses.index');
    }

    public function create()
    {
        return view('pages.zoom-courses.create');
    }

    public function show($slug)
    {
        $zoomCourse = ZoomCourse::where('slug', $slug)->first();

        $zoomCourse == null ? $this->redierctTo('zoom-courses') : true;

        return view('pages.zoom-courses.show')->with('zoomCourse', $zoomCourse);
    }

    public function level($slug, $level_slug)
    {
        $zoomCourse = ZoomCourse::where('slug',$slug)->first();
        
        $zoomCourseLevel = ZoomCourseLevel::where('zoom_course_id', $zoomCourse->id)->where('slug', $level_slug)->first();

        $zoomCourseLevel == null ? $this->redierctTo('zoom-course/show/'.$zoomCourseLevel->belongsToZoomCourse->slug) : true;

        return view('pages.zoom-courses.level')
        ->with('zoomCourse', $zoomCourse)
        ->with('zoomCourseLevel', $zoomCourseLevel);
    }

    public function session($slug, $level_slug, $sesion_slug)
    {
        $zoomCourseLevelSession = ZoomCourse::where('slug', $slug)->first()->levels->where('slug', $level_slug)->first()->sessions->where('slug', $sesion_slug)->first();

        $zoomCourseLevelSession == null ? $this->redierctTo('zoom-course/show/'.$zoomCourseLevelSession->belongsToZoomCourseLevel->slug) : true;
        
        $exerciseUsers = ExerciseUser::where('exercise_id', $zoomCourseLevelSession->exersice_id)->get();

        $exercises = Exercise::get();

        return view('pages.zoom-courses.session')
        ->with('zoomCourseLevelSession', $zoomCourseLevelSession)
        ->with('exercises', $exercises)
        ->with('exerciseUsers', $exerciseUsers);
    }

    public function sessionUserAnswers($slug, $level_slug, $sesion_slug, $live_course_user_id)
    {
        $zoomCourseLevelSession = ZoomCourse::where('slug', $slug)->first()->levels->where('slug', $level_slug)->first()->sessions->where('slug', $sesion_slug)->first();
        
        $exerciseUser = ExerciseUser::where('live_course_user_id', $live_course_user_id)->first();
        $exercise = Exercise::where('id', $zoomCourseLevelSession->exersice_id)->first();

        $exercise_json_file = public_path('uploads/exercises/exercise/'.$exercise->slug.'/exercise.json');

        $exercise_json_data = json_encode(json_decode(file_get_contents($exercise_json_file), JSON_PRETTY_PRINT), true);

        $exercise_pages = json_decode($exercise_json_data, true)['pages'];

        return view('pages.zoom-courses.user-session-answers', compact('zoomCourseLevelSession', 'exerciseUser', 'exercise_pages', 'exercise'));
    }
}
