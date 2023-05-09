<?php

namespace App\Models\ZoomCourses;

use App\Models\EnrolledStudents\EnrolledStudentForZoomCourse;
use Illuminate\Database\Eloquent\Model;

class ZoomCourseLevelUser extends Model
{
    protected $table = 'zoom_course_level_users';

    protected $fillable = [
        'enrolled_for_zoom_course_id', 'zoom_course_level_id'
    ];

    public function belongsToEnrolledZoomCourseUser()
    {
        return $this->belongsTo(EnrolledStudentForZoomCourse::class, 'enrolled_for_zoom_course_id', 'id');
    }
}
