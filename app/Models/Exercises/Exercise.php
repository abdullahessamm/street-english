<?php

namespace App\Models\Exercises;

use App\Models\Exercises\ExerciseQuestion;
use App\Models\Exercises\ExerciseUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    protected $fillable = [
        'title', 'description', 'publish', 'slug'
    ];

    public function questions()
    {
        return $this->hasMany(ExerciseQuestion::class, 'exercise_id', 'id');
    }

    public function users()
    {
        return $this->hasMany(ExerciseUser::class, 'exercise_id', 'id');
    }
}
