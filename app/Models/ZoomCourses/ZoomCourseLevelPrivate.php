<?php

namespace App\Models\ZoomCourses;

use App\Models\Coaches\Coach;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZoomCourseLevelPrivate extends Model
{
    use HasFactory;

    protected $table = 'zoom_course_level_privates';
    protected $fillable = [
        'zoom_course_level_id', 'live_course_user_id', 'instructor_id'
    ];

    public function level()
    {
        return $this->belongsTo(ZoomCourseLevel::class, 'zoom_course_level_id', 'id');
    }

    public function student()
    {
        return $this->belongsTo(ZoomCourseUser::class, 'live_course_user_id', 'id');
    }

    public function instructor()
    {
        return $this->belongsTo(Coach::class, 'instructor_id', 'id');
    }

    public function sessions()
    {
        return $this->belongsToMany(ZoomCourseSession::class, ZoomCourseLevelPrivateSession::class, 'private_id', 'session_id')
        ->as('info')
        ->using(SessionInfoPivot::class)
        ->withPivot([
            'time', 'duration', 'room_link'
        ]);
    }
}
