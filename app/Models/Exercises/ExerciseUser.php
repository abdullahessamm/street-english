<?php

namespace App\Models\Exercises;

use App\LiveCourseUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExerciseUser extends Model
{
    protected $fillable = [
        'exercise_id', 'live_course_user_id', 'hasJoined', 'joined_at', 'hasFinished', 'finished_at', 'browser', 'os', 'ip', 'isBot', 'hasCheated', 'hasBeenCorrected', 'slug',
    ];

    public function belongsToExercise()
    {
        return $this->belongsTo(Exercise::class, 'exercise_id', 'id');
    }

    public function belongsToLiveCourseUser()
    {
        return $this->belongsTo(LiveCourseUser::class, 'live_course_user_id', 'id');
    }

    public function answers()
    {
        return $this->hasMany(ExerciseUser::class, 'exercise_user_id', 'id');
    }
}
