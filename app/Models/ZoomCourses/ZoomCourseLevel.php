<?php

namespace App\Models\ZoomCourses;

use Illuminate\Database\Eloquent\Model;

class ZoomCourseLevel extends Model
{
    protected $table = 'zoom_course_levels';

    protected $fillable = [
        'zoom_course_id',
        'title',
        'description',
        'slug'
    ];

    public function course()
    {
        return $this->belongsTo(ZoomCourse::class, 'zoom_course_id', 'id');
    }

    public function groups()
    {
        return $this->hasMany(ZoomCourseLevelGroup::class, 'zoom_course_level_id', 'id');
    }

    public function privates()
    {
        return $this->hasMany(ZoomCourseLevelPrivate::class, 'zoom_course_level_id', 'id');
    }

    public function exam()
    {
        return $this->hasOne(ZoomCourseLevelExam::class, 'level_id', 'id');
    }
}
