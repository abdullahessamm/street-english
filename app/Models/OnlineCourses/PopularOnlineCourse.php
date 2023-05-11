<?php

namespace App\Models\OnlineCourses;

use Illuminate\Database\Eloquent\Model;

class PopularOnlineCourse extends Model
{
    protected $table = 'popular_online_courses';

    protected $fillable = [
        'online_course_id'
    ];

    public function belongsToOnlineCourse()
    {
        return $this->belongsTo(OnlineCourse::class, 'online_course_id', 'id');
    }
}
