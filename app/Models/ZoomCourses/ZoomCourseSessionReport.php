<?php

namespace App\Models\ZoomCourses;

use App\Models\Coaches\Coach;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZoomCourseSessionReport extends Model
{
    use HasFactory;
    
    protected $table = 'zoom_course_session_reports';
    protected $fillable = [
        'session_id',
        'live_course_user_id',
        'instructor_id',
        'attended_at',
        'lateness',
        'did_assignment',
        'participation',
        'weakness_points',
        'strength_points',
        'notes',
    ];

    protected $casts = [
        'attended_at' => 'datetime',
    ];

    public function session()
    {
        return $this->belongsTo(ZoomCourseSession::class, 'session_id', 'id');
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
