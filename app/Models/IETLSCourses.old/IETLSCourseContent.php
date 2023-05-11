<?php

namespace App\Models\IETLSCourses;

use Illuminate\Database\Eloquent\Model;

class IETLSCourseContent extends Model
{
    protected $table = 'ietls_course_contents';

    protected $fillable = [
        'ietls_course_id', 'title',
    ];
    
    public function belongsToCourse()
    {
        return $this->belongsTo(IETLSCourse::class, 'ietls_course_id', 'id');
    }

    public function lessons()
    {
        return $this->hasMany(IETLSCourseLesson::class, 'ietls_course_content_id', 'id');
    }
}
