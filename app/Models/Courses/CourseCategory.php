<?php

namespace App\Models\Courses;

use Illuminate\Database\Eloquent\Model;

class CourseCategory extends Model
{
    protected $table = 'course_categories';

    protected $fillable = [
        'category_name', 'slug'
    ];

    public function onlineCourses()
    {
        return $this->hasMany(OnlineCourse::class, 'course_id', 'id');
    }

    public function onlineCourse()
    {
        return $this->hasOne(OnlineCourse::class, 'course_id', 'id');
    }
}
