<?php

namespace App\Models\MySessions;

use Illuminate\Database\Eloquent\Model;

class MySessionsBooking extends Model
{
    protected $table = 'my_session_bookings';

    protected $fillable = [
        'my_session_appointment_id', 'user_id', 'name', 'email', 'whatsapp_number', 'slug'
    ];

    public function belongsToAppointment()
    {
        return $this->belongsTo(MySessionAppointment::class, 'my_session_appointment_id', 'id');
    }
}
