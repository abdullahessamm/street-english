<?php

namespace App\Models\IETLSCourses;

use Illuminate\Database\Eloquent\Model;

class IETLSCourseLessonDoc extends Model
{
    protected $table = 'Ietls_course_lesson_docs';

    protected $fillable = [
        'Ietls_course_lesson_id', 'pdf', 'pages', 'isDownloadable'
    ];
    
    public function belongsToCourseLesson()
    {
        return $this->belongsTo(IETLSCourseLesson::class, 'Ietls_course_lesson_id', 'id');
    }
}
