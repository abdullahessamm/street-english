<?php

namespace App\Models\OnlineCourses;

use Illuminate\Database\Eloquent\Model;

class OnlineCourseLesson extends Model
{
    protected $table = 'online_course_lessons';

    protected $fillable = [
        'online_course_content_id', 'title', 'video', 'video_description', 'isLocked', 'slug'
    ];
    
    public function belongsToContent()
    {
        return $this->belongsTo(OnlineCourseContent::class, 'online_course_content_id', 'id');
    }
}
