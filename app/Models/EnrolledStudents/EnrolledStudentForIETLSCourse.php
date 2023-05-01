<?php

namespace App\Models\EnrolledStudents;

use App\Models\IETLSCourses\IeltsUser;
use App\Models\IETLSCourses\IETLSCourse;
use App\Models\ZoomCourses\ZoomCourse;
use App\Models\ZoomCourses\ZoomCourseUser;
use Illuminate\Database\Eloquent\Model;

class EnrolledStudentForIETLSCourse extends Model
{
    protected $table = 'enrolled_students_for_Ietls_courses';

    protected $fillable = [
        'ielts_user_id', 'Ietls_course_id'
    ];

    public function belongsToStudent()
    {
        return $this->belongsTo(IeltsUser::class, 'ietls_user_id', 'id');
    }

    public function belongsToCourse()
    {
        return $this->belongsTo(IETLSCourse::class, 'Ietls_course_id', 'id');
    }
}
