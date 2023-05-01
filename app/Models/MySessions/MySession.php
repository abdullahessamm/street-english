<?php

namespace App\Models\MySessions;

use Illuminate\Database\Eloquent\Model;

class MySession extends Model
{
    protected $table = 'my_sessions';

    protected $fillable = [
        'name', 'description', 'slug'
    ];

    public function dates()
    {
        return $this->hasMany(MySessionDate::class, 'my_session_id', 'id');
    }
}
