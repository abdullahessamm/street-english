<?php

namespace App\Models\IETLSCourses;

use App\Models\Exams\Exam;
use Illuminate\Database\Eloquent\Model;

class IETLSCourseLessonExercise extends Model
{
    protected $table = 'Ietls_course_lesson_exercises';

    protected $fillable = [
        'Ietls_course_lesson_id', 'exam_id', 'title', 'description', 'isRepeatable',
    ];

    public function belongsToCourseLesson()
    {
        return $this->belongsTo(IETLSCourseLesson::class, 'Ietls_course_lesson_id', 'id');
    }

    public function belongsToExam()
    {
        return $this->belongsTo(Exam::class, 'exam_id', 'id');
    }
}
