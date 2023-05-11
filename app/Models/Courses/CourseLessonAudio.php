<?php

namespace App\Models\Courses;

use Illuminate\Database\Eloquent\Model;

class CourseLessonAudio extends Model
{
    protected $table = 'course_lesson_audio';

    protected $fillable = [
        'course_lesson_id', 'audio', 'duration', 'type', 'size', 'isDownloadable'
    ];
    
    public function belongsToCourseLesson()
    {
        return $this->belongsTo(CourseLesson::class, 'course_lesson_id', 'id');
    }
}
