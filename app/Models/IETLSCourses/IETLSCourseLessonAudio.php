<?php

namespace App\Models\IETLSCourses;

use Illuminate\Database\Eloquent\Model;

class IETLSCourseLessonAudio extends Model
{
    protected $table = 'Ietls_course_lesson_audio';

    protected $fillable = [
        'Ietls_course_lesson_id', 'audio', 'duration', 'type', 'size', 'isDownloadable'
    ];
    
    public function belongsToCourseLesson()
    {
        return $this->belongsTo(IETLSCourseLesson::class, 'Ietls_course_lesson_id', 'id');
    }
}
