<?php

namespace App\Models\Courses;

use App\Models\Coaches\Coach;
use Illuminate\Database\Eloquent\Model;

class CourseInstructor extends Model
{
    protected $table = 'course_instructors';

    protected $fillable = [
        'coach_id', 'course_id', 'suspend', 'approved',
    ];

    public function belongsToInstructor()
    {
        return $this->belongsTo(Coach::class, 'coach_id', 'id');
    }
}
