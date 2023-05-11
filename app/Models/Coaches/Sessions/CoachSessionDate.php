<?php

namespace App\Models\Coaches\Sessions;

use Illuminate\Database\Eloquent\Model;

class CoachSessionDate extends Model
{
    protected $table = 'coach_session_dates';

    protected $fillable = [
        'coach_session_id', 'date', 'slug',
    ];

    public function belongsToCoachSession()
    {
        return $this->belongsTo(CoachSession::class, 'coach_session_id', 'id');
    }

    public function appointments()
    {
        return $this->hasMany(CoachSessionAppointment::class, 'coach_session_date_id', 'id');
    }
}
