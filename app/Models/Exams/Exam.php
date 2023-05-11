<?php

namespace App\Models\Exams;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $table = 'exams';

    protected $fillable = [
        'exam_name', 'take_exam_anytime', 'exam_hours', 'exam_timezone', 'exam_date', 'start_at', 'end_at', 'full_mark', 'slug', 'publish', 'for_anyone'
    ];

    public function sections()
    {
        return $this->hasMany(ExamSection::class, 'exam_id', 'id');
    }

    public function questions()
    {
        return $this->hasManyThrough(ExamQuestion::class, ExamSection::class, 'exam_id', 'section_id');
    }

    public function registedUsers()
    {
        return $this->hasMany(RegistedUserExam::class, 'exam_id', 'id');
    }
}
