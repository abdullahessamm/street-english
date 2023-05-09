<?php

namespace App\Models\EnrolledStudents;

use App\Models\Courses\Course;
use App\Models\Students\Student;
use Illuminate\Database\Eloquent\Model;

class EnrolledStudentForCourse extends Model
{
    protected $table = 'enrolled_students_for_courses';

    protected $fillable = [
        'user_id', 'course_id'
    ];

    public function belongsToStudent()
    {
        return $this->belongsTo(Student::class, 'user_id', 'id');
    }

    public function course()
    {
        return $this->hasOne(Course::class, 'course_id', 'id');
    }
}
