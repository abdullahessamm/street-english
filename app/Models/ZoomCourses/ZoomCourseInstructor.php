<?php

namespace App\Models\ZoomCourses;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZoomCourseInstructor extends Model
{
    use HasFactory;

    protected $fillable = [
        'coach_id',
        'zoom_course_id',
        'suspend',
        'approved',
    ];
}
