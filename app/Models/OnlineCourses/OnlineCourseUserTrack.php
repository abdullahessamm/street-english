<?php

namespace App\Models\Courses;

use App\Models\Students\Student;
use Illuminate\Database\Eloquent\Model;

class CourseUserTrack extends Model
{
    protected $table = 'course_user_tracks';

    protected $fillable = [
        'user_id', 'course_lesson_id ',
    ];

    public function belongsToUser()
    {
        return $this->belongsTo(Student::class, 'user_id', 'id');
    }

    public function belongsToLesson()
    {
        return $this->belongsTo(CourseLesson::class, 'course_lesson_id', 'id');
    }
}
