<?php

namespace App\Models\ZoomCourses;

use Illuminate\Database\Eloquent\Model;

class ZoomCourseLevel extends Model
{
    protected $table = 'zoom_course_levels';

    protected $fillable = [
        'zoom_course_id', 'title', 'description', 'private_price', 'group_price', 'slug'
    ];

    public function belongsToZoomCourse()
    {
        return $this->belongsTo(ZoomCourse::class, 'zoom_course_id', 'id');
    }

    public function sessions()
    {
        return $this->hasMany(ZoomCourseSession::class, 'zoom_course_level_id', 'id');
    }

    public function users()
    {
        return $this->hasMany(ZoomCourseLevelUser::class, 'zoom_course_level_id', 'id');
    }
}
