<?php

namespace App\Models\OnlineCourses;

use App\Models\Coaches\Coach;
use Illuminate\Database\Eloquent\Model;

class OnlineCourseInstructor extends Model
{
    protected $table = 'online_course_instructors';

    protected $fillable = [
        'coach_id', 'online_course_id', 'suspend', 'approved',
    ];

    public function belongsToInstructor()
    {
        return $this->belongsTo(Coach::class, 'coach_id', 'id');
    }
}
