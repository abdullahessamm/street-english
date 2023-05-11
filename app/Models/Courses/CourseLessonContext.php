<?php

namespace App\Models\Courses;

use Illuminate\Database\Eloquent\Model;

class CourseLessonContext extends Model
{
    protected $table = 'course_lesson_contexts';

    protected $fillable = [
        'course_lesson_id', 'content'
    ];
    
    public function belongsToCourseLesson()
    {
        return $this->belongsTo(CourseLesson::class, 'course_lesson_id', 'id');
    }
}
