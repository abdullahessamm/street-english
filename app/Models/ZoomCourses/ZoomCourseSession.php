<?php

namespace App\Models\ZoomCourses;

use App\Models\Exams\Exam;
use App\Models\Exercises\Exercise;
use App\Models\ZoomCourses\Exercises\ZoomCoursesExercise;
use Illuminate\Database\Eloquent\Model;

class ZoomCourseSession extends Model
{
    protected $table = 'zoom_course_sessions';

    protected $fillable = [
        'zoom_course_level_id', 'title', 'description', 'exersice_id', 'slug'
    ];

    public function belongsToZoomCourseLevel()
    {
        return $this->belongsTo(ZoomCourseLevel::class, 'zoom_course_level_id', 'id');
    }

    public function users()
    {
        return $this->hasMany(ZoomCourseSessionUser::class, 'zoom_course_session_id', 'id');
    }

    public function exersice()
    {
        return $this->hasOne(Exercise::class, 'id', 'exersice_id');
    }

    public function zoomCoursesExercise()
    {
        return $this->hasOne(ZoomCoursesExercise::class, 'zoom_course_session_id', 'id');
    }
}
