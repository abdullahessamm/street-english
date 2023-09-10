<?php

namespace App\Models\ZoomCourses;

use App\Models\Exams\Exam;
use Illuminate\Database\Eloquent\Model;

class ZoomCourseSession extends Model
{
    protected $table = 'zoom_course_sessions';

    protected $fillable = [
        'zoom_course_level_id', 'title', 'description'
    ];

    public function level()
    {
        return $this->belongsTo(ZoomCourseLevel::class, 'zoom_course_level_id', 'id');
    }

    public function groups()
    {
        return $this->belongsToMany(ZoomCourseLevelGroup::class, ZoomCourseLevelGroupSession::class, 'session_id', 'group_id')
        ->withPivot([
            'time', 'duration', 'room_link'
        ]);
    }

    public function privates()
    {
        return $this->belongsToMany(ZoomCourseLevelPrivate::class, ZoomCourseLevelPrivateSession::class, 'session_id', 'private_id')
        ->withPivot([
            'time', 'duration', 'room_link'
        ]);
    }

    public function materials()
    {
        return $this->hasMany(ZoomCourseSessionMaterial::class, 'session_id', 'id');
    }

    public function exercises() {
        return $this->belongsToMany(Exam::class, ZoomCourseSessionExercisePivot::class, 'session_id', 'exam_id')
        ->withPivot(['opened', 'title']);
    }
}
