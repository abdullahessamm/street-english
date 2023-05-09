<?php

namespace App\Models\ZoomCourses;

use Illuminate\Database\Eloquent\Model;

class ZoomCourseSessionUser extends Model
{
    protected $table = 'zoom_course_session_users';

    protected $fillable = [
        'zoom_course_level_user_id', 'zoom_course_session_id',
    ];

    public function belongsToZoomCourseLevelUser()
    {
        return $this->belongsTo(ZoomCourseLevelUser::class, 'zoom_course_level_user_id', 'id');
    }
}
