<?php

namespace App\Models\IETLSCourses;

use App\Models\Students\Student;
use Illuminate\Database\Eloquent\Model;

class UserIETLSCourseTrack extends Model
{
    protected $table = 'user_Ietls_course_track';

    protected $fillable = [
        'user_id', 'Ietls_course_id', 'Ietls_course_content_id', 'Ietls_course_lesson_id', 'isFinished'
    ];

    public function belongsToStudent()
    {
        return $this->belongsTo(IeltsUser::class, 'user_id', 'id');
    }

    public function belongsToCourse()
    {
        return $this->belongsTo(Course::class, 'Ietls_course_id', 'id');
    }

    public function belongsToCourseContent()
    {
        return $this->belongsTo(IETLSCourseContent::class, 'Ietls_course_content_id', 'id');
    }

    public function belongsToCourseLesson()
    {
        return $this->belongsTo(IETLSCourseLesson::class, 'Ietls_course_lesson_id', 'id');
    }
}
