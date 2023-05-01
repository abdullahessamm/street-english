<?php

namespace App\Models\OnlineCourses;

use Illuminate\Database\Eloquent\Model;

class OnlineCourseContent extends Model
{
    protected $table = 'online_course_contents';

    protected $fillable = [
        'online_course_id', 'title', 'description',
    ];
    
    public function belongsToCourse()
    {
        return $this->belongsTo(OnlineCourse::class, 'online_course_id', 'id');
    }

    public function lessons()
    {
        return $this->hasMany(OnlineCourseLesson::class, 'online_course_content_id', 'id');
    }
}
