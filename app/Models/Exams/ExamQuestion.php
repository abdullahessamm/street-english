<?php

namespace App\Models\Exams;

use Illuminate\Database\Eloquent\Model;

class ExamQuestion extends Model
{
    protected $table = 'exam_questions';

    protected $fillable = [
        'section_id', 'question', 'score'
    ];

    public function answers()
    {
        return $this->hasMany(ExamAnswer::class, 'question_id', 'id');
    }

    public function correctAnswer()
    {
        return $this->hasOne(CorrectAnswer::class, 'question_id', 'id');
    }
}
