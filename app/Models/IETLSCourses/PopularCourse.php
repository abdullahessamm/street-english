<?php

namespace App\Models\IETLSCourses;

use Illuminate\Database\Eloquent\Model;

class PopularIETLSCourse extends Model
{
    protected $table = 'popular_courses';

    protected $fillable = [
        'ietls_course_id'
    ];

    public function belongsToCourse()
    {
        return $this->belongsTo(IETLSCourse::class, 'ietls_course_id', 'id');
    }
}