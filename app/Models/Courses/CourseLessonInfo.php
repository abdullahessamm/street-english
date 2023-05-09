<?php

namespace App\Models\Courses;

use Illuminate\Database\Eloquent\Model;

class CourseLessonInfo extends Model
{
    protected $table = 'course_lesson_infos';

    protected $fillable = [
        'course_lesson_id', 'isLocked', 'isContinueable', 'isAchievable', 'isPublished', 'points'
    ];
    
    public function belongsToCourseLesson()
    {
        return $this->belongsTo(CourseLesson::class, 'course_lesson_id', 'id');
    }
}
