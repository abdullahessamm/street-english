<?php

namespace App\Models\IETLSCourses;

use Illuminate\Database\Eloquent\Model;

class IETLSCourseLessonInfo extends Model
{
    protected $table = 'Ietls_course_lesson_infos';

    protected $fillable = [
        'Ietls_course_lesson_id', 'isLocked', 'isContinueable', 'isAchievable', 'isPublished', 'points'
    ];
    
    public function belongsToCourseLesson()
    {
        return $this->belongsTo(IETLSCourseLesson::class, 'Ietls_course_lesson_id', 'id');
    }
}
