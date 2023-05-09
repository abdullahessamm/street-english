<?php

namespace App\Models\Courses;

use App\Models\EnrolledStudents\EnrolledStudentForCourse;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'courses';

    protected $fillable = [
        'course_category_id', 'name', 'duration', 'level', 'language', 'price', 'discount', 'media_intro', 'video_url', 'image', 'banner', 'thumbnail', 'description', 'isPublished', 'slug'
    ];

    public function instructors()
    {
        return $this->hasMany(CourseInstructor::class, 'course_id', 'id');
    }

    public function contents()
    {
        return $this->hasMany(CourseContent::class, 'course_id', 'id');
    }

    public function enrolledStudents()
    {
        return $this->hasMany(EnrolledStudentForCourse::class, 'course_id', 'id');
    }

    public function category()
    {
        return $this->hasOne(CourseCategory::class, 'id', 'course_category_id');
    }
}
