<?php

namespace App\Models\TrainingCourses;

use App\Models\Coaches\Coach;
use Illuminate\Database\Eloquent\Model;

class TrainingCourseInstructor extends Model
{
    protected $table = 'training_course_instructors';

    protected $fillable = [
        'coach_id', 'training_course_id', 'suspend',
    ];

    public function belongsToInstructor()
    {
        return $this->belongsTo(Coach::class, 'coach_id', 'id');
    }
}
