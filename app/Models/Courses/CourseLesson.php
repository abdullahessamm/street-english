<?php

namespace App\Models\Courses;

use Illuminate\Database\Eloquent\Model;

class CourseLesson extends Model
{
    protected $table = 'course_lessons';

    protected $fillable = [
        'course_content_id', 'title', 'description', 'type', 'slug'
    ];
    
    public function belongsToContent()
    {
        return $this->belongsTo(CourseContent::class, 'course_content_id', 'id');
    }

    public function instructor()
    {
        return $this->hasOne(CourseLessonInstructor::class, 'course_lesson_id', 'id');
    }

    public function info()
    {
        return $this->hasOne(CourseLessonInfo::class, 'course_lesson_id', 'id');
    }

    public function video()
    {
        return $this->hasOne(CourseLessonVideo::class, 'course_lesson_id', 'id');
    }

    public function audio()
    {
        return $this->hasOne(CourseLessonAudio::class, 'course_lesson_id', 'id');
    }

    public function doc()
    {
        return $this->hasOne(CourseLessonDoc::class, 'course_lesson_id', 'id');
    }

    public function context()
    {
        return $this->hasOne(CourseLessonContext::class, 'course_lesson_id', 'id');
    }

    public function frame()
    {
        return $this->hasOne(CourseLessonFrame::class, 'course_lesson_id', 'id');
    }

    public function exercise()
    {
        return $this->hasOne(CourseLessonExercise::class, 'course_lesson_id', 'id');
    }
}
