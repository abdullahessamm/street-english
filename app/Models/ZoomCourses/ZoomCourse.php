<?php

namespace App\Models\ZoomCourses;

use App\Models\Coaches\Coach;
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

    public function students()
    {
        return $this
        ->belongsToMany(ZoomCourseUser::class, EnrolledStudentForZoomCourse::class, 'zoom_course_id', 'live_course_user_id');
    }

    public function instructors()
    {
        return $this
        ->belongsToMany(Coach::class, ZoomCourseInstructor::class, 'zoom_course_id', 'coach_id');
    }

}
