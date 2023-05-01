<?php

namespace App\Models\Coaches\Sessions;

use Illuminate\Database\Eloquent\Model;

class CoachSessionBooking extends Model
{
    protected $table = 'coach_session_bookings';

    protected $fillable = [
        'coach_session_appointment_id', 'user_id', 'name', 'email', 'whatsapp_number', 'slug'
    ];

    public function belongsToAppointment()
    {
        return $this->belongsTo(CoachSessionAppointment::class, 'coach_session_appointment_id', 'id');
    }
}
