<?php

namespace App\Models\ZoomCourses;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZoomCourseSessionExercisePivot extends Model
{
    use HasFactory;

    protected $table = 'zoom_course_session_exercise_pivots';
    
    public $timestamps = false;

    protected $fillable = [
        'exam_id',
        'session_id',
        'opened',
        'title',
    ];
}
