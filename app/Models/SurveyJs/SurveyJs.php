<?php

namespace App\Models\SurveyJs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyJs extends Model
{
    protected $fillable = [
        'title', 'description', 'slug'
    ];

    public function questions()
    {
        return $this->hasMany(SurveyQuestion::class, 'survey_id', 'id');
    }
}
