<?php

namespace App\Models\ZoomCourses;

use Illuminate\Database\Eloquent\Model;

class ZoomCourseUserInfo extends Model
{
    protected $table = 'live_course_user_info';

    protected $fillable = [
        'live_course_user_id', 
        'image', 
        'whatsapp_number', 
    ];

    public function belongsToCoach()
    {
        return $this->belongsTo(ZoomCourseUser::class, 'live_course_user_id', 'id');
    }
}
