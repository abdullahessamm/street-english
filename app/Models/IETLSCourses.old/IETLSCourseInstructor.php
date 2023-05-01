<?php

namespace App\Models\IETLSCourses;

use App\Models\Coaches\Coach;
use Illuminate\Database\Eloquent\Model;

class IETLSCourseInstructor extends Model
{
    protected $table = 'ietls_course_instructors';

    protected $fillable = [
        'coach_id', 'ietls_course_id', 'approved', 'suspend',
    ];

    public function belongsToInstructor()
    {
        return $this->belongsTo(Coach::class, 'coach_id', 'id');
    }
}
