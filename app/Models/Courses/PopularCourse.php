<?php

namespace App\Models\Courses;

use Illuminate\Database\Eloquent\Model;

class PopularCourse extends Model
{
    protected $table = 'popular_courses';

    protected $fillable = [
        'course_id'
    ];

    public function belongsToCourse()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }
}