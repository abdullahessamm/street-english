<?php

namespace App\Models\Exams;

use Illuminate\Database\Eloquent\Model;

class CorrectAnswer extends Model
{
    protected $table = 'exam_correct_answers';

    protected $fillable = [
        'question_id', 'answer_id'
    ];
}
