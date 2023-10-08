<?php

namespace App\Models\ZoomCourses;

use App\Models\Coaches\Coach;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZoomCourseLevelGroup extends Model
{
    use HasFactory;

    protected $table = "zoom_course_level_groups";
    protected $fillable = [
        'zoom_course_level_id', 'name', 'instructor_id'
    ];

    public function level()
    {
        return $this->belongsTo(ZoomCourseLevel::class, 'zoom_course_level_id', 'id');
    }

    public function instructor()
    {
        return $this->belongsTo(Coach::class, 'instructor_id', 'id');
    }

    public function students()
    {
        return $this->belongsToMany(ZoomCourseUser::class, ZoomCourseLevelGroupsUsersPivot::class, 'group_id', 'live_course_user_id')
        ->as('info')
        ->withPivot('joined_at');
    }

    public function sessions()
    {
        return $this->belongsToMany(ZoomCourseSession::class, ZoomCourseLevelGroupSession::class, 'group_id', 'session_id')
        ->as('info')
        ->using(SessionInfoPivot::class)
        ->withPivot([
            'time', 'duration', 'room_link'
        ]);
    }
}
