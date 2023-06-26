<?php

namespace App\Models\ZoomCourses;

use Illuminate\Database\Eloquent\Model;

class ZoomCourseLevel extends Model
{
    protected $table = 'zoom_course_levels';

    protected $fillable = [
        'zoom_course_id', 'title', 'description', 'private_price', 'group_price', 'slug'
    ];

    public function course()
    {
        return $this->belongsTo(ZoomCourse::class, 'zoom_course_id', 'id');
    }

    public function sessions()
    {
        return $this->hasMany(ZoomCourseSession::class, 'zoom_course_level_id', 'id');
    }

    public function students()
    {
        return $this
        ->belongsToMany(ZoomCourseUser::class, ZoomCourseLevelUser::class, 'zoom_course_level_id', 'enrolled_for_zoom_course_id');
    }
}
