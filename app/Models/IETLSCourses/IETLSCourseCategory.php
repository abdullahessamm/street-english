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

    public function courses()
    {
        return $this->hasMany(IETLSCourse::class, 'Ietls_course_category_id', 'id');
    }
}
