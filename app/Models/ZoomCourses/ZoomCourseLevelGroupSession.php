<?php

namespace App\Models\ZoomCourses;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZoomCourseLevelGroupSession extends Model
{
    use HasFactory;

    protected $table = 'zoom_course_level_group_sessions';
    
    public $timestamps = false;
    
    protected $fillable = [
        'group_id', 'session_id', 'time', 'duration', 'room_link'
    ];

    protected $casts = [
        'time' => 'datetime'
    ];
}
