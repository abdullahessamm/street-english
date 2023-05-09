<?php

namespace App\Models\ZoomCourses;

use App\Models\EnrolledStudents\EnrolledStudentForZoomCourse;
use Illuminate\Database\Eloquent\Model;

class ZoomCourse extends Model
{
    protected $table = 'zoom_courses';

    protected $fillable = [
        'title', 'image', 'description', 'private_price', 'group_price', 'isPublished', 'slug'
    ];

    public function levels()
    {
        return $this->hasMany(ZoomCourseLevel::class, 'zoom_course_id', 'id');
    }

    public function enrolledStudents()
    {
        return $this->hasMany(EnrolledStudentForZoomCourse::class, 'zoom_course_id', 'id');
    }

}
