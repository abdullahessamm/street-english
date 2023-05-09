<?php

namespace App\Models\EnrolledStudents;

use App\Models\IETLSCourses\IeltsUser;
use App\Models\IETLSCourses\IETLSCourse;
use Illuminate\Database\Eloquent\Model;

class EnrolledStudentForIETLSCourse extends Model
{
    protected $table = 'enrolled_students_for_Ietls_courses';

    protected $fillable = [
        'ietls_user_id', 'Ietls_course_id'
    ];

    public function belongsToStudent()
    {
        return $this->belongsTo(IeltsUser::class, 'ietls_user_id', 'id');
    }

    public function course()
    {
        return $this->hasOne(IETLSCourse::class, 'Ietls_course_id', 'id');
    }
}
