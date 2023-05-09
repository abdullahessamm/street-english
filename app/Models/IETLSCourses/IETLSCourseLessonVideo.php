<?php

namespace App\Models\IETLSCourses;

use Illuminate\Database\Eloquent\Model;

class IETLSCourseLessonVideo extends Model
{
    protected $table = 'Ietls_course_lesson_videos';

    protected $fillable = [
        'Ietls_course_lesson_id', 'type', 'url',
    ];
    
    public function belongsToCourseLesson()
    {
        return $this->belongsTo(IETLSCourseLesson::class, 'Ietls_course_lesson_id', 'id');
    }
}
