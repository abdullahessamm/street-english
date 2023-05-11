<?php

namespace App\Models\Courses;

use App\Models\Coaches\Coach;
use Illuminate\Database\Eloquent\Model;

class CourseLessonInstructor extends Model
{
    protected $table = 'course_lesson_instructors';

    protected $fillable = [
        'course_lesson_id', 'coach_id',
    ];
    
    public function belongsToCourseLesson()
    {
        return $this->belongsTo(CourseLesson::class, 'course_lesson_id', 'id');
    }

    public function belongsToInstructor()
    {
        return $this->belongsTo(Coach::class, 'coach_id', 'id');
    }
}
