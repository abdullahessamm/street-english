<?php

namespace App\Models\IETLSCourses;

use Illuminate\Database\Eloquent\Model;

class IETLSCourseLessonFrame extends Model
{
    protected $table = 'ietls_course_lesson_frames';

    protected $fillable = [
        'ietls_course_lesson_id', 'url'
    ];
    
    public function belongsToCourseLesson()
    {
        return $this->belongsTo(IETLSCourseLesson::class, 'ietls_course_lesson_id', 'id');
    }
}
