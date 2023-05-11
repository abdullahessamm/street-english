<?php

namespace App\Models\IETLSCourses;

use Illuminate\Database\Eloquent\Model;

class IETLSCourseContent extends Model
{
    protected $table = 'Ietls_course_contents';

    protected $fillable = [
        'Ietls_course_id', 'title', 'description', 'slug',
    ];
    
    public function belongsToCourse()
    {
        return $this->belongsTo(IETLSCourse::class, 'Ietls_course_id', 'id');
    }

    public function lessons()
    {
        return $this->hasMany(IETLSCourseLesson::class, 'Ietls_course_content_id', 'id');
    }
}
