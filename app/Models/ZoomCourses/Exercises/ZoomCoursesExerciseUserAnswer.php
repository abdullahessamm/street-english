<?php

namespace App\Models\ZoomCourses\Exercises;

use App\Models\Exams\CorrectAnswer;
use App\Models\Exams\ExamAnswer;
use App\Models\Exams\ExamQuestion;
use App\Models\ZoomCourses\ZoomCourseSession;
use App\Models\ZoomCourses\ZoomCourseUser;
use Illuminate\Database\Eloquent\Model;

class ZoomCoursesExerciseUserAnswer extends Model
{
    protected $table = 'zoom_courses_exercise_user_answers';

    protected $fillable = [
        'live_course_user_id', 'session_id', 'question_id', 'answer_id', 'correct_answer_id', 'score'
    ];

    public function belongsToStudent()
    {
        return $this->belongsTo(ZoomCourseUser::class, 'live_course_user_id', 'id');
    }

    public function belongsToZoomCourseSession()
    {
        return $this->belongsTo(ZoomCourseSession::class, 'zoom_course_session_id', 'id');
    }

    public function belongsToExamQuestion()
    {
        return $this->belongsTo(ExamQuestion::class, 'question_id', 'id');
    }

    public function belongsToExamAnswer()
    {
        return $this->belongsTo(ExamAnswer::class, 'answer_id', 'id');
    }

    public function belongsToCorrectAnswer()
    {
        return $this->belongsTo(CorrectAnswer::class, 'correct_answer_id', 'id');
    }
}
