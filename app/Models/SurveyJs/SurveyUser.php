<?php

namespace App\Models\SurveyJs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyUser extends Model
{
    protected $fillable = [
        'survey_id', 'username', 'email', 'phone_number', 'whatsapp_number', 'hasJoined', 'joined_at', 'hasFinished', 'finished_at', 'browser', 'os', 'ip', 'isBot', 'hasCheated', 'hasBeenCorrected', 'slug',
    ];

    public function belongsToSurveyJs()
    {
        return $this->belongsTo(SurveyJs::class, 'survey_id', 'id');
    }

    public function answers()
    {
        return $this->hasMany(SurveyAnswer::class, 'survey_user_id', 'id');
    }
}
