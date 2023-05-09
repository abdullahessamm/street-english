<?php

namespace App\Models\ZoomCourses\Exercises;

use App\Models\ZoomCourses\ZoomCourseSession;
use App\Models\ZoomCourses\ZoomCourseUser;
use Illuminate\Database\Eloquent\Model;

class ZoomCoursesExercise extends Model
{
    protected $table = 'zoom_courses_exercises';

    protected $fillable = [
        'live_course_user_id', 'zoom_course_session_id', 'joined_at', 'finished_at'
    ];

    public function belongsToStudent()
    {
        return $this->belongsTo(ZoomCourseUser::class, 'live_course_user_id', 'id');
    }

    public function belongsToZoomCourseSession()
    {
        return $this->belongsTo(ZoomCourseSession::class, 'zoom_course_session_id', 'id');
    }
}
