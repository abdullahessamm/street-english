<?php

namespace App\Models\ZoomCourses;

use Illuminate\Database\Eloquent\Relations\Pivot;

class LiveCourseUserCourse extends Pivot
{
    CONST STATUS_ACTIVE   = 0;
    CONST STATUS_DELAYED  = 1;
    CONST STATUS_FINISHED = 2;
    CONST AVAILABLE_STATUS = [
        self::STATUS_ACTIVE, self::STATUS_DELAYED, self::STATUS_FINISHED
    ];

    protected $table = 'live_course_user_courses';
    
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'course_id',
        'status',
        'started_at',
        'delayed_at',
        'finished_at'
    ];

    protected $casts = [
        'started_at'    => 'date',
        'delayed_at'    => 'date',
        'finished_at'   => 'date'
    ];

    protected $hidden = [
        'user_id', 'course_id',
    ];
}
