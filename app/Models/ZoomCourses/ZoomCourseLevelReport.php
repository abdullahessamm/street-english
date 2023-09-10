<?php

namespace App\Models\ZoomCourses;

use App\Models\Coaches\Coach;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZoomCourseLevelReport extends Model
{
    use HasFactory;

    protected $table = 'zoom_course_level_reports';
    protected $fillable = [
        'level_id',
        'live_course_user_id',
        'instructor_id',
        'attendance',
        'lateness',
        'participation',
        'weakness_points',
        'strength_points',
        'notes',
    ];

    public function level()
    {
        return $this->belongsTo(ZoomCourseLevel::class, 'level_id', 'id');
    }

    public function student()
    {
        return $this->belongsTo(ZoomCourseUser::class, 'live_course_user_id', 'id');
    }

    public function instructor()
    {
        return $this->belongsTo(Coach::class, 'instructor_id', 'id');
    }
}
