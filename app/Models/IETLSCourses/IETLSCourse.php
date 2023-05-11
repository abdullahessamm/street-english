<?php

namespace App\Models\IETLSCourses;

use App\Models\EnrolledStudents\EnrolledStudentForCourse;
use App\Models\EnrolledStudents\EnrolledStudentForIETLSCourse;
use Illuminate\Database\Eloquent\Model;

class IETLSCourse extends Model
{
    protected $table = 'Ietls_courses';

    protected $fillable = [
        'ietls_course_category_id', 'name', 'duration', 'level', 'language', 'price', 'discount', 'media_intro', 'video_url', 'image', 'banner', 'thumbnail', 'description', 'isPublished', 'slug'
    ];

    public function instructors()
    {
        return $this->hasMany(IETLSCourseInstructor::class, 'ietls_course_id', 'id');
    }

    public function contents()
    {
        return $this->hasMany(IETLSCourseContent::class, 'ietls_course_id', 'id');
    }

    public function lessons()
    {
        return $this->hasManyThrough(IETLSCourseLesson::class, IETLSCourseContent::class, 'Ietls_course_id', 'Ietls_course_content_id');
    }

    public function enrolledStudents()
    {
        return $this->hasMany(EnrolledStudentForIETLSCourse::class, 'ietls_course_id', 'id');
    }
}
