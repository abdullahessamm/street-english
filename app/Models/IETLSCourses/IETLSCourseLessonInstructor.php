<?php

namespace App\Models\IETLSCourses;

use App\Models\Coaches\Coach;
use Illuminate\Database\Eloquent\Model;

class IETLSCourseLessonInstructor extends Model
{
    protected $table = 'Ietls_course_lesson_instructors';

    protected $fillable = [
        'Ietls_course_lesson_id', 'coach_id',
    ];
    
    public function belongsToCourseLesson()
    {
        return $this->belongsTo(IETLSCourseLesson::class, 'Ietls_course_lesson_id', 'id');
    }

    public function belongsToInstructor()
    {
        return $this->belongsTo(Coach::class, 'coach_id', 'id');
    }
}
