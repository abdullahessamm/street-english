<?php

namespace App\Models\Events;

use Illuminate\Database\Eloquent\Model;

class EventUser extends Model
{
    protected $table = 'event_users';

    protected $fillable = [
        'event_id', 'username', 'email', 'whatsapp_number',
    ];
}
