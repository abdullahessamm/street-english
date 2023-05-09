<?php

namespace App\Models\Courses;

use Illuminate\Database\Eloquent\Model;

class CourseLessonDoc extends Model
{
    protected $table = 'course_lesson_docs';

    protected $fillable = [
        'course_lesson_id', 'pdf', 'pages', 'isDownloadable'
    ];
    
    public function belongsToCourseLesson()
    {
        return $this->belongsTo(CourseLesson::class, 'course_lesson_id', 'id');
    }
}
