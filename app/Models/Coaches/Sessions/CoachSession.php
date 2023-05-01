<?php

namespace App\Models\Coaches\Sessions;

use App\Coach;
use Illuminate\Database\Eloquent\Model;

class CoachSession extends Model
{
    protected $table = 'coach_sessions';

    protected $fillable = [
        'coach_id', 'name', 'description', 'slug'
    ];

    public function belongsToCoach()
    {
        return $this->belongsTo(Coach::class, 'coach_id', 'id');
    }

    public function dates()
    {
        return $this->hasMany(CoachSessionDate::class, 'coach_session_id', 'id');
    }
}
