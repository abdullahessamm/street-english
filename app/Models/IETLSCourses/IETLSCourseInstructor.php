<?php

namespace App\Models\IETLSCourses;

use App\Models\Coaches\Coach;
use Illuminate\Database\Eloquent\Model;

class IETLSCourseInstructor extends Model
{
    protected $table = 'Ietls_course_instructors';

    protected $fillable = [
        'coach_id', 'Ietls_course_id', 'suspend', 'approved',
    ];

    public function belongsToInstructor()
    {
        return $this->belongsTo(Coach::class, 'coach_id', 'id');
    }
}
