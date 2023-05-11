<?php

namespace App\Models\Courses;

use Illuminate\Database\Eloquent\Model;

class CourseLessonVideo extends Model
{
    protected $table = 'course_lesson_videos';

    protected $fillable = [
        'course_lesson_id', 'type', 'url',
    ];
    
    public function belongsToCourseLesson()
    {
        return $this->belongsTo(CourseLesson::class, 'course_lesson_id', 'id');
    }
}
