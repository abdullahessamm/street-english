<?php

namespace App\Models\SurveyJs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyAnswer extends Model
{
    protected $fillable = [
        'survey_user_id', 'survey_question_id', 'my_answer', 'correct_answer', 'question_score', 'user_score', 'isAnswerCorrect',
    ];

    public function belongsToSurveyQuestion()
    {
        return $this->belongsTo(SurveyQuestion::class, 'survey_question_id', 'id');
    }

    public function belongsToSurveyJs()
    {
        return $this->belongsTo(SurveyJs::class, 'survey_id', 'id');
    }
}
