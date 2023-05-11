<?php

namespace App\Models\Exams;

use Illuminate\Database\Eloquent\Model;

class ExamAnswer extends Model
{
    protected $table = 'exam_answers';

    protected $fillable = [
        'question_id', 'answer',
    ];

    
    public function belongsToQuestion() 
    {
        return $this->belongsTo(ExamQuestion::class, 'question_id', 'id');
    }

    public function correctAnswer()
    {
        return $this->hasOne(CorrectAnswer::class, 'answer_id', 'id');
    }
}
