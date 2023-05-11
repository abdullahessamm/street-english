<?php

namespace App\Models\MySessions;

use Illuminate\Database\Eloquent\Model;

class MySessionDate extends Model
{
    protected $table = 'my_session_dates';

    protected $fillable = [
        'my_session_id', 'date', 'timezone', 'slug'
    ];

    public function appointments()
    {
        return $this->hasMany(MySessionAppointment::class, 'my_session_date_id', 'id');
    }

    public function belongsToMySession()
    {
        return $this->belongsTo(MySession::class, 'my_session_id', 'id');
    }
}
