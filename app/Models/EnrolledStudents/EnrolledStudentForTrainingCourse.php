<?php

namespace App\Models\EnrolledStudents;

use App\Models\Students\Student;
use App\Models\TrainingCourses\TrainingCourse;
use Illuminate\Database\Eloquent\Model;

class EnrolledStudentForTrainingCourse extends Model
{
    protected $table = 'enrolled_student_for_training_courses';

    protected $fillable = [
        'user_id', 'training_course_id', 'name', 'email', 'whatsapp_number', 'ticket', 'slug',
    ];

    public function belongsToStudent()
    {
        return $this->belongsTo(Student::class, 'user_id', 'id');
    }

    public function course()
    {
        return $this->hasOne(TrainingCourse::class, 'training_course_id', 'id');
    }
}
