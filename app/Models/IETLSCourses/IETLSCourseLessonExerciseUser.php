<?php

namespace App\Models\IETLSCourses;

use Illuminate\Database\Eloquent\Model;

class IETLSCourseLessonExerciseUser extends Model
{
    protected $table = 'Ietls_course_lesson_exercise_users';

    protected $fillable = [
        'user_id', 'Ietls_course_lesson_exercise_id', 'isFinished',
    ];

    public function belongsToStudent()
    {
        return $this->belongsTo(IeltsUser::class, 'ielts_user_id', 'id');
    }

    public function belongsToPlacementTestUser()
    {
        return $this->belongsTo(IETLSCourseLessonExercise::class, 'Ietls_course_lesson_exercise_id', 'id');
    }
}
