<?php

namespace App\Models\Courses;

use Illuminate\Database\Eloquent\Model;

class CourseLessonExerciseUser extends Model
{
    protected $table = 'course_lesson_exercise_users';

    protected $fillable = [
        'user_id', 'course_lesson_exercise_id', 'isFinished',
    ];

    public function belongsToStudent()
    {
        return $this->belongsTo(Student::class, 'user_id', 'id');
    }

    public function belongsToPlacementTestUser()
    {
        return $this->belongsTo(CourseLessonExercise::class, 'course_lesson_exercise_id', 'id');
    }
}
