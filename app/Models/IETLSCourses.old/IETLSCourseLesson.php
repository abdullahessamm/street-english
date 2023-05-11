<?php

namespace App\Models\IETLSCourses;

use Illuminate\Database\Eloquent\Model;

class IETLSCourseLesson extends Model
{
    protected $table = 'ietls_course_lessons';

    protected $fillable = [
        'ietls_course_content_id', 'title', 'video_type', 'video_url', 'video_description', 'isLocked', 'slug'
    ];
    
    public function belongsToContent()
    {
        return $this->belongsTo(IETLSCourseContent::class, 'ietls_course_content_id', 'id');
    }
}
