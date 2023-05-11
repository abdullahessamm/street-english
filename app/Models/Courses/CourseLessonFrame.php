<?php

namespace App\Models\Courses;

use Illuminate\Database\Eloquent\Model;

class CourseLessonFrame extends Model
{
    protected $table = 'course_lesson_frames';

    protected $fillable = [
        'course_lesson_id', 'url'
    ];
    
    public function belongsToCourseLesson()
    {
        return $this->belongsTo(CourseLesson::class, 'course_lesson_id', 'id');
    }
}
