<?php

namespace App\Models\ZoomCourses;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZoomCourseLevelPrivateSession extends Model
{
    use HasFactory;

    protected $table = 'zoom_course_level_private_sessions';
    
    public $timestamps = false;
    
    protected $fillable = [
        'private_id', 'session_id', 'time', 'duration', 'room_link'
    ];

    protected $casts = [
        'time' => 'datetime'
    ];
}
