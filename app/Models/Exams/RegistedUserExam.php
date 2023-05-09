<?php

namespace App\Models\Exams;

use App\Models\Students\Student;
use Illuminate\Database\Eloquent\Model;

class RegistedUserExam extends Model
{
    protected $table = 'registed_user_exams';

    protected $fillable = [
        'user_id', 'exam_id', 'joined_at', 'finished_at', 'slug'
    ];

    
    public function belongsToExam()
    {
        return $this->belongsTo(Exam::class, 'exam_id', 'id');
    }

    public function belongsToStudent()
    {
        return $this->belongsTo(Student::class, 'user_id', 'id');
    }
}
