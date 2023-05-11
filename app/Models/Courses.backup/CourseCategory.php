<?php

namespace App\Models\Courses;

use Illuminate\Database\Eloquent\Model;

class CourseCategory extends Model
{
    protected $table = 'course_categories';

    protected $fillable = [
        'category_name', 'slug'
    ];

    public function Courses()
    {
        return $this->hasMany(Course::class, 'course_id', 'id');
    }

    public function Course()
    {
        return $this->hasOne(Course::class, 'course_id', 'id');
    }
}
