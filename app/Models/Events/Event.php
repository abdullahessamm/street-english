<?php

namespace App\Models\Events;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';

    protected $fillable = [
        'title', 'image', 'description', 'end_date', 'slug',
    ];

    public function users()
    {
        return $this->hasMany(EventUser::class, 'event_id', 'id');
    }
}
