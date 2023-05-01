<?php

namespace App\Models\Courses;

use App\Models\Exams\Exam;
use Illuminate\Database\Eloquent\Model;

class CourseLessonExercise extends Model
{
    protected $table = 'course_lesson_exercises';

    protected $fillable = [
        'course_lesson_id', 'exam_id', 'title', 'description', 'isRepeatable',
    ];

    public function belongsToCourseLesson()
    {
        return $this->belongsTo(CourseLesson::class, 'course_lesson_id', 'id');
    }

    public function belongsToExam()
    {
        return $this->belongsTo(Exam::class, 'exam_id', 'id');
    }

    public function courseLessonExerciseUser()
    {
        return $this->hasOne(CourseLessonExerciseUser::class, 'course_lesson_exercise_id', 'id');
    }
}
