<?php

namespace App\Http\Controllers\Student\MyCourses;

use App\Http\Controllers\Controller;
use App\Models\Courses\Course;
use Illuminate\Http\Request;
use App\Models\Courses\CourseLesson;
use App\Models\Courses\CourseLessonExerciseAnswer;
use App\Models\Courses\CourseLessonExerciseUser;
use App\Models\Courses\CourseLessonTrack;
use App\Models\Exams\ExamQuestion;

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

    public function finishLessonExercise(Request $request)
    {
        $user_id = $request->input('user_id');
        $course_lesson_exercise_id = $request->input('exercise_id');
        $my_answers = $request->input('my_answers');

        $courseLessonExerciseUser = CourseLessonExerciseUser::firstOrCreate(['user_id' => $user_id, 'course_lesson_exercise_id' => $course_lesson_exercise_id],[
            'user_id' => $user_id,
            'course_lesson_exercise_id' => $course_lesson_exercise_id,
            'isFinished' => 1,
        ]);

        for($i = 0; $i < count($my_answers); $i++){

            $question_id = $my_answers[$i]['question'];
            $answer_id = $my_answers[$i]['answer'];
            $correct_answer_id = ExamQuestion::where('id', $my_answers[$i]['question'])->first()->correctAnswer->id;
            $score = $my_answers[$i]['answer'] == null || $my_answers[$i]['answer'] != ExamQuestion::where('id', $my_answers[$i]['question'])->first()->correctAnswer->answer_id ? 0 : ExamQuestion::where('id', $my_answers[$i]['question'])->first()->score;
        
            CourseLessonExerciseAnswer::create([
                'exercise_user_id' => $courseLessonExerciseUser->id,
                'question_id' => $question_id,
                'answer_id' => $answer_id,
                'correct_answer_id' => $correct_answer_id,
                'score' => $score,
            ]);
        }

        $this->reloadPage();
    }
}
