<?php

namespace App\Models\Courses;

use App\Models\Students\Student;
use Illuminate\Database\Eloquent\Model;

class UserCourseTrack extends Model
{
    protected $table = 'user_course_track';

    protected $fillable = [
        'user_id', 'course_id', 'course_content_id', 'course_lesson_id', 'isFinished'
    ];

    public function belongsToStudent()
    {
        return $this->belongsTo(Student::class, 'user_id', 'id');
    }

    public function belongsToCourse()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    public function belongsToCourseContent()
    {
        return $this->belongsTo(CourseContent::class, 'course_content_id', 'id');
    }

    public function belongsToCourseLesson()
    {
        return $this->belongsTo(CourseLesson::class, 'course_lesson_id', 'id');
    }
}
