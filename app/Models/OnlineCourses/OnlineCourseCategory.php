<?php

namespace App\Models\OnlineCourses;

use Illuminate\Database\Eloquent\Model;

class OnlineCourseCategory extends Model
{
    protected $table = 'online_course_categories';

    protected $fillable = [
        'category_name', 'slug'
    ];

    public function onlineCourses()
    {
        return $this->hasMany(OnlineCourse::class, 'online_course_id', 'id');
    }

    public function onlineCourse()
    {
        return $this->hasOne(OnlineCourse::class, 'online_course_id', 'id');
    }
}
