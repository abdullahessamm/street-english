<?php

namespace App\Models\Courses;

use App\Models\Exams\CorrectAnswer;
use App\Models\Exams\ExamAnswer;
use App\Models\Exams\ExamQuestion;
use App\Models\Students\Student;
use Illuminate\Database\Eloquent\Model;

class CourseLessonExerciseAnswer extends Model
{
    protected $table = 'course_lesson_exercise_answers';

    protected $fillable = [
        'exercise_user_id', 'question_id', 'answer_id', 'correct_answer_id', 'score'
    ];

    public function belongsToStudent()
    {
        return $this->belongsTo(CourseLessonExerciseUser::class, 'user_id', 'id');
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
