<?php

namespace App\Models\IETLSCourses;

use Illuminate\Database\Eloquent\Model;

class IETLSCourseLesson extends Model
{
    protected $table = 'Ietls_course_lessons';

    protected $fillable = [
        'Ietls_course_content_id', 'title', 'description', 'type', 'slug'
    ];
    
    public function belongsToContent()
    {
        return $this->belongsTo(IETLSCourseContent::class, 'Ietls_course_content_id', 'id');
    }

    public function instructor()
    {
        return $this->hasOne(IETLSCourseLessonInstructor::class, 'Ietls_course_lesson_id', 'id');
    }

    public function info()
    {
        return $this->hasOne(IETLSCourseLessonInfo::class, 'Ietls_course_lesson_id', 'id');
    }

    public function video()
    {
        return $this->hasOne(IETLSCourseLessonVideo::class, 'Ietls_course_lesson_id', 'id');
    }

    public function audio()
    {
        return $this->hasOne(IETLSCourseLessonAudio::class, 'Ietls_course_lesson_id', 'id');
    }

    public function doc()
    {
        return $this->hasOne(IETLSCourseLessonDoc::class, 'Ietls_course_lesson_id', 'id');
    }

    public function context()
    {
        return $this->hasOne(IETLSCourseLessonContext::class, 'Ietls_course_lesson_id', 'id');
    }

    public function frame()
    {
        return $this->hasOne(IETLSCourseLessonFrame::class, 'Ietls_course_lesson_id', 'id');
    }

    public function exercise()
    {
        return $this->hasOne(IETLSCourseLessonExercise::class, 'Ietls_course_lesson_id', 'id');
    }
}
