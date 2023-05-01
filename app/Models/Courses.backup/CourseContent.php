<?php

namespace App\Models\Courses;

use Illuminate\Database\Eloquent\Model;

class CourseContent extends Model
{
    protected $table = 'course_contents';

    protected $fillable = [
        'course_id', 'title',
    ];
    
    public function belongsToCourse()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    public function lessons()
    {
        return $this->hasMany(CourseLesson::class, 'course_content_id', 'id');
    }
}
