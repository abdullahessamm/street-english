<?php

namespace App\Models\IETLSCourses;

use App\Models\Students\Student;
use Illuminate\Database\Eloquent\Model;

class IETLSCourseUserTrack extends Model
{
    protected $table = 'ietls_course_user_tracks';

    protected $fillable = [
        'user_id', 'ietls_course_lesson_id ',
    ];

    public function belongsToUser()
    {
        return $this->belongsTo(Student::class, 'user_id', 'id');
    }

    public function belongsToLesson()
    {
        return $this->belongsTo(IETLSCourseLesson::class, 'ietls_course_lesson_id', 'id');
    }
}
