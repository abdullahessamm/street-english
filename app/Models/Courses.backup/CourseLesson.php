<?php

namespace App\Models\Courses;

use Illuminate\Database\Eloquent\Model;

class CourseLesson extends Model
{
    protected $table = 'course_lessons';

    protected $fillable = [
        'course_content_id', 'title', 'video_type', 'video_url', 'video_description', 'isLocked', 'slug'
    ];
    
    public function belongsToContent()
    {
        return $this->belongsTo(CourseContent::class, 'course_content_id', 'id');
    }
}
