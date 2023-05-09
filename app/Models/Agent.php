<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    protected $table = 'agents';

    protected $fillable = [
        'name', 'email', 'title', 'image', 'about', 'facebook', 'twitter', 'linkedIn', 'gmail', 'whatsapp_number',
    ];
}
