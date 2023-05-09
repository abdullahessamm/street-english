<?php

namespace App\Models\IETLSCourses;

use App\Models\Students\Student;
use Illuminate\Database\Eloquent\Model;

class IETLSCourseLessonExerciseAnswer extends Model
{
    protected $table = 'Ietls_course_lesson_exercise_answers';

    protected $fillable = [
        'exercise_user_id', 'question_id', 'answer_id', 'correct_answer_id', 'score'
    ];

    public function belongsToStudent()
    {
        return $this->belongsTo(IETLSCourseLessonExerciseUser::class, 'user_id', 'id');
    }
}
