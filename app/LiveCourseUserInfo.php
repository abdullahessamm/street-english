<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LiveCourseUserInfo extends Model
{
    protected $table = 'live_course_user_info';

    protected $guarded = [];

    protected $fillabe = [
        'live_course_user_id', 'image', 'whatsapp_number', 
    ];

    public function belongsToLiveCourseUser()
    {
        return $this->belongsTo(LiveCourseUser::class, 'foreign_key', 'other_key');
    }
}
