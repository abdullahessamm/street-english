<?php

namespace App\Models\Coaches;

use Illuminate\Database\Eloquent\Model;

class CoachInfo extends Model
{
    protected $table = 'coach_info';

    protected $fillable = [
        'coach_id', 
        'image',
        'bio_video',
        'title', 
        'about', 
        'facebook', 
        'twitter', 
        'linkedin', 
        'gmail', 
        'whatsapp_number', 
        'isAllowedForMakingSession',
        'isAllowedForPublishCourses',
        'isAllowedForPublishBlogs',
    ];

    public function belongsToCoach()
    {
        return $this->belongsTo(Coach::class, 'coach_id', 'id');
    }
}
