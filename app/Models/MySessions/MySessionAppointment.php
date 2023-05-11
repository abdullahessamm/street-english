<?php

namespace App\Models\MySessions;

use App\Models\Students\Student;
use Illuminate\Database\Eloquent\Model;

class MySessionAppointment extends Model
{
    protected $table = 'my_session_appointments';

    protected $fillable = [
        'my_session_date_id', 'start_time', 'end_time', 'link', 'isTaken'
    ];

    public function belongsToMySessionDate()
    {
        return $this->belongsTo(MySessionDate::class, 'my_session_date_id', 'id');
    }

    public function bookings()
    {
        return $this->hasMany(MySessionsBooking::class, 'my_session_appointment_id', 'id');
    }

    public function booking()
    {
        return $this->hasOne(MySessionsBooking::class, 'my_session_appointment_id', 'id');
    }
}
