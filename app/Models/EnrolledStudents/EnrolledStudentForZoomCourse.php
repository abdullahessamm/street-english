<?php

namespace App\Models\EnrolledStudents;

use App\Models\ZoomCourses\ZoomCourse;
use App\Models\ZoomCourses\ZoomCourseLevelUser;
use App\Models\ZoomCourses\ZoomCourseUser;
use Illuminate\Database\Eloquent\Model;

class EnrolledStudentForZoomCourse extends Model
{
    protected $table = 'enrolled_students_for_zoom_courses';

    protected $fillable = [
        'live_course_user_id', 'zoom_course_id'
    ];

    public function belongsToStudent()
    {
        return $this->belongsTo(ZoomCourseUser::class, 'live_course_user_id', 'id');
    }

    public function belongsToZoomCourse()
    {
        return $this->belongsTo(ZoomCourse::class, 'zoom_course_id', 'id');
    }

    public function zoomCourses()
    {
        return $this->hasMany(ZoomCourse::class, 'zoom_course_id', 'id');
    }

    public function zoomCourseLevels()
    {
        return $this->hasMany(ZoomCourseLevelUser::class, 'enrolled_for_zoom_course_id', 'id');
    }
}
