<?php

namespace App\Models\Exercises;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExerciseQuestion extends Model
{
    protected $fillable = [
        'exercise_id', 'question', 'question_name', 'score',
    ];

    public function belongsToExercise()
    {
        return $this->belongsTo(Exercise::class, 'exercise_id', 'id');
    }
}
