<?php

namespace App\Models\IETLSCourses;

use Illuminate\Database\Eloquent\Model;

class IETLSCourseLessonContext extends Model
{
    protected $table = 'Ietls_course_lesson_contexts';

    protected $fillable = [
        'Ietls_course_lesson_id', 'content'
    ];
    
    public function belongsToCourseLesson()
    {
        return $this->belongsTo(IETLSCourseLesson::class, 'Ietls_course_lesson_id', 'id');
    }
}
