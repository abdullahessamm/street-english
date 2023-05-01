<?php

namespace App\Models\Coaches\Sessions;

use Illuminate\Database\Eloquent\Model;

class CoachSessionAppointment extends Model
{
    protected $table = 'coach_session_appointments';

    protected $fillable = [
        'coach_session_date_id', 'start_time', 'end_time', 'link', 'isTaken'
    ];

    public function belongsToCoachSession()
    {
        return $this->belongsTo(CoachSessionDate::class, 'coach_session_date_id', 'id');
    }
}
