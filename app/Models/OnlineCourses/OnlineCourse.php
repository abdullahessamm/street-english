<?php

namespace App\Models\OnlineCourses;

use App\Models\EnrolledStudents\EnrolledStudentForOnlineCourse;
use Illuminate\Database\Eloquent\Model;

class OnlineCourse extends Model
{
    protected $table = 'courses';

    protected $fillable = [
        'course_category_id', 'name', 'duration', 'level', 'language', 'price', 'discount', 'media_intro', 'video_url', 'image', 'banner', 'thumbnail', 'description', 'slug'
    ];

    public function instructors()
    {
        return $this->hasMany(OnlineCourseInstructor::class, 'course_id', 'id');
    }

    public function contents()
    {
        return $this->hasMany(OnlineCourseContent::class, 'course_id', 'id');
    }

    public function enrolledStudents()
    {
        return $this->hasMany(EnrolledStudentForOnlineCourse::class, 'course_id', 'id');
    }
}
