<?php

namespace App\Models\IETLSCourses;

use App\Models\IETLSCourses\IETLSCourse;
use Illuminate\Database\Eloquent\Model;

class IETLSCourseCategory extends Model
{
    protected $table = 'Ietls_course_categories';

    protected $fillable = [
        'category_name', 'slug'
    ];

    public function onlineCourses()
    {
        return $this->hasMany(IETLSCourse::class, 'Ietls_course_id', 'id');
    }

    public function onlineCourse()
    {
        return $this->hasOne(IETLSCourse::class, 'Ietls_course_id', 'id');
    }
}
