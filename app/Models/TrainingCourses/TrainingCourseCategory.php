<?php

namespace App\Models\TrainingCourses;

use Illuminate\Database\Eloquent\Model;

class TrainingCourseCategory extends Model
{
    protected $table = 'training_course_categories';

    protected $fillable = [
        'category_name', 'slug'
    ];

    public function traingingCourses()
    {
        return $this->hasMany(TrainingCourse::class, 'training_course_id', 'id');
    }

    public function traingingCourse()
    {
        return $this->hasOne(TrainingCourse::class, 'training_course_id', 'id');
    }
}
