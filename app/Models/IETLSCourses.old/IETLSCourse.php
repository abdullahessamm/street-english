<?php

namespace App\Models\IETLSCourses;

use Illuminate\Database\Eloquent\Model;

class IETLSCourse extends Model
{
    protected $table = 'ietls_courses';

    protected $fillable = [
        'name', 'duration', 'level', 'language', 'isFree', 'price', 'media_intro', 'video_url', 'video_intro_type', 'image', 'banner', 'thumbnail', 'description', 'slug'
    ];

    public function instructors()
    {
        return $this->hasMany(IETLSCourseInstructor::class, 'ietls_course_id', 'id');
    }

    public function contents()
    {
        return $this->hasMany(IETLSCourseContent::class, 'ietls_course_id', 'id');
    }

    public function enrolledStudents()
    {
        return $this->hasMany(EnrolledStudentForIETLSCourse::class, 'ietls_course_id', 'id');
    }

    public function lessons()
    {
        return $this->hasManyThrough(IETLSCourseLesson::class, IETLSCourseContent::class, 'ietls_course_id', 'ietls_course_content_id');
    }

    public function discount()
    {
        return $this->hasOne(IETLSCourseDiscount::class, 'ietls_course_id', 'id');
    }

    public function coupon()
    {
        return $this->hasOne(IETLSCourseCouponDiscount::class, 'ietls_course_id', 'id');
    }
}
