<?php

namespace App\Models\Courses;

use Illuminate\Database\Eloquent\Model;

class CourseCategory extends Model
{
    protected $table = 'course_categories';

    protected $fillable = [
        'category_name', 'slug'
    ];

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
