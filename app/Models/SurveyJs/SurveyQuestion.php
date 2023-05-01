<?php

namespace App\Models\SurveyJs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyQuestion extends Model
{
    protected $fillable = [
        'survey_id', 'question', 'question_name', 'score',
    ];

    public function belongsToSurveyJs()
    {
        return $this->belongsTo(SurveyJs::class, 'survey_id', 'id');
    }
}
