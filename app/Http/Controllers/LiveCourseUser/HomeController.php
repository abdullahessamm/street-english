<?php

namespace App\Http\Controllers\LiveCourseUser;

use App\Http\Controllers\Controller;
use App\LiveCourseUser;
use App\LiveCourseUserInfo;
use Illuminate\Http\Request;
use App\Models\EnrolledStudents\EnrolledStudentForZoomCourse;
use App\Models\Exams\Exam;
use App\Models\Exams\ExamQuestion;
use App\Models\Exercises\ExerciseAnswer;
use App\Models\Exercises\Exercise;
use App\Models\Exercises\ExerciseQuestion;
use App\Models\Exercises\ExerciseUser;
use App\Models\ZoomCourses\Exercises\ZoomCoursesExercise;
use App\Models\ZoomCourses\Exercises\ZoomCoursesExerciseUserAnswer;
use App\Models\ZoomCourses\ZoomCourseLevelUser;
use App\Models\ZoomCourses\ZoomCourseSession;
use App\Models\ZoomCourses\ZoomCourseSessionUser;
use App\Models\ZoomCourses\ZoomCourseUser;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('live_course_user.auth:live_course_user');
    }

    /**
     * Show the LiveCourseUser dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $zoomCourseUser = ZoomCourseUser::where('id', Auth::guard('live_course_user')->user()->id)->first();

        $myZoomCourses = EnrolledStudentForZoomCourse::where('live_course_user_id', Auth::guard('live_course_user')->user()->id)->get();

        return view('live-course-user.home')
        ->with('zoomCourseUser', $zoomCourseUser)
        ->with('myZoomCourses', $myZoomCourses);
    }

    public function settings()
    {
        $user = LiveCourseUser::where('id', Auth::guard('live_course_user')->user()->id)->first();

        return view('live-course-user.settings', compact('user'));
    }

    public function updatePassword(Request $request)
    {
        $old_password = $request->input('old_password');
        $new_password = $request->input('new_password');
        $confirm_password = $request->input('confirm_password');

        $user = LiveCourseUser::where('id', Auth::guard('live_course_user')->user()->id)->first();

        !Hash::check($old_password, $user->password) ? $this->errorMsg('Old password is incorrect') : true;

        $new_password != $confirm_password ? $this->errorMsg("Password don't matched") : true;

        $user->update([
            'password' => Hash::make($new_password)
        ]);

        Auth::logout();

        $this->successMsg('Your Password has been changed');

        $this->reloadPage();
    }
    
    public function updateImage(Request $request)
    {
        $user = LiveCourseUser::where('id', Auth::guard('live_course_user')->user()->id)->first();
        
        if($request->hasFile('image')){
            
            !in_array($request->file('image')->getClientOriginalExtension(), ['jpeg', 'png', 'jpg']) ? $this->errorMsg('Your profile image extension is not valid') : true;

            // check if user has image
            $old_image = $this->getUniversalPath('public/public/images/live-course-users/'.$user->id.'/'.$user->image);

            // remove image if exists
            file_exists($old_image) ? $this->removeFile($old_image) : true;

            // get user image
            $user_image_path = $this->getUniversalPath('public/public/images/live-course-users/'.$user->id);

            // get new image name
            $image_name = md5(uniqid());

            // upload new image
            $this->uploadFile($request, 'image', $user_image_path, $image_name);

            // update image data in user database
            LiveCourseUserInfo::updateOrCreate(['live_course_user_id' => $user->id], [
                'live_course_user_id' => $user->id,
                'image' => $image_name.'.'.$request->file('image')->getClientOriginalExtension(),
            ]);

            $this->successMsg('Image has been updated');

            $this->reloadPage();
        }
    }

    public function liveCourse($id)
    {
        $zoomCourseUser = ZoomCourseUser::where('id', Auth::guard('live_course_user')->user()->id)->first();

        $myZoomCourse = EnrolledStudentForZoomCourse::where('id', $id)->first();

        return view('live-course-user.show')
        ->with('zoomCourseUser', $zoomCourseUser)
        ->with('myZoomCourse', $myZoomCourse);
    }

    public function liveCourseLevel($live_course_id, $live_course_level_id)
    {
        $zoomCourseUser = ZoomCourseUser::where('id', Auth::guard('live_course_user')->user()->id)->first();

        $myZoomCourseLevel = ZoomCourseLevelUser::where('zoom_course_level_id', $live_course_level_id)->first();
        
        return view('live-course-user.level')
        ->with('zoomCourseUser', $zoomCourseUser)
        ->with('myZoomCourseLevel', $myZoomCourseLevel);
    }

    public function liveCourseLevelSession($live_course_id, $live_course_level_id, $live_course_session_id)
    {
        $zoomCourseUser = ZoomCourseUser::where('id', Auth::guard('live_course_user')->user()->id)->first();

        $myZoomCourseSession = ZoomCourseSession::where('id', $live_course_session_id)->first();

        $myZoomCourseSession->exersice == null ? abort(404) : true;

        $live_course_user_id = Auth::guard('live_course_user')->user()->id;
        $my_zoom_course_session_id = $myZoomCourseSession->id;

        $liveCourseUser = LiveCourseUser::where('id', $live_course_user_id)->first();

        $exersice_json_file = $this->getUniversalPath('public/uploads/exercises/exercise/'.$myZoomCourseSession->exersice->slug.'/exercise.json', 'admin');
        
        $exersice_json_file = json_encode(json_decode(file_get_contents($exersice_json_file), JSON_PRETTY_PRINT), true);
        
        $zoomCoursesExerciseUserAnswer = ZoomCoursesExerciseUserAnswer::where('live_course_user_id', $live_course_user_id)->where('session_id', $my_zoom_course_session_id)->get();

        $exerciseUser = ExerciseUser::where('live_course_user_id', $live_course_user_id)->where('exercise_id', $myZoomCourseSession->exersice->id)->first();

        return view('live-course-user.session')
        ->with('zoomCourseUser', $zoomCourseUser)
        ->with('myZoomCourseSession', $myZoomCourseSession)
        ->with('live_course_user_id', $live_course_user_id)
        ->with('my_zoom_course_session_id', $my_zoom_course_session_id)
        ->with('zoomCoursesExerciseUserAnswer', $zoomCoursesExerciseUserAnswer)
        ->with('exerciseUser', $exerciseUser)
        ->with('exersice_json_file', $exersice_json_file)
        ->with('liveCourseUser', $liveCourseUser);
    }

    public function startSessionExersice(Request $request)
    {
        $live_course_user_id = $request->input('live_course_user_id');
        $exercise_id = $request->input('exersice_id');
        
        ExerciseUser::firstOrCreate(['live_course_user_id' => $live_course_user_id, 'exercise_id' => $exercise_id], [
            'live_course_user_id' => $live_course_user_id,
            'exercise_id' => $exercise_id,
            'hasJoined' => 1,
            'joined_at' => Carbon::now(),
            'slug' => md5(uniqid()),
        ]);

        $this->reloadPage();
    }

    public function submitSessionExersice(Request $request)
    {
        $live_course_user_id = $request->input('live_course_user_id');
        $exercise_id = $request->input('exercise_id');
        $answers = $request->input('surveyData');
        
        $exercise = Exercise::where('id', $exercise_id)->first();

        $exerciseUser = ExerciseUser::where('exercise_id', $exercise_id)->where('live_course_user_id', $live_course_user_id)->first();

        $exercise_json_file = $this->getUniversalPath('public/uploads/exercises/exercise/'.$exercise->slug.'/exercise.json', 'admin');
        
        $exercise_json_data = json_encode(json_decode(file_get_contents($exercise_json_file), JSON_PRETTY_PRINT), true);

        $pages = json_decode($exercise_json_data, true)['pages'];

        $questions_name = [];

        for($i = 0; $i < count($pages); $i++){

            for($j = 0; $j < count($pages[$i]['elements']); $j++){

                $questions_name[] = $pages[$i]['elements'][$j]['name'];
            }
        }

        foreach($questions_name as $question_name){

            $exerciseQuestion = ExerciseQuestion::where('exercise_id', $exercise_id)->where('question_name', $question_name)->first();

            $question_id = $exerciseQuestion == null ? null : $exerciseQuestion->id;
            
            if($question_id != null){
    
                ExerciseAnswer::firstOrCreate(['exercise_user_id' => $exerciseUser->id, 'exercise_question_id' => $question_id],[
                    'exercise_user_id' => $exerciseUser->id,
                    'exercise_question_id' => $question_id,
                    'my_answer' => isset($answers[$question_name]) ? (is_array($answers[$question_name]) ? serialize($answers[$question_name]) : $answers[$question_name]) : null,
                ]);
            }
        }

        $exerciseUser->update([
            'hasFinished' => 1,
            'finished_at' => Carbon::now(),
        ]);

        $this->reloadPage();
    }
}
