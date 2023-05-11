<?php

namespace App\Models\Coaches;

use App\Models\Courses\CourseInstructor;
use Illuminate\Database\Eloquent\Model;

class Coach extends Model
{
    protected $table = 'coaches';
    
    protected $fillable = [
        'name', 'email', 'password', 'gender', 'phone',
    ];

    
    protected $hidden = [
        'password', 'remember_token',
    ];

    
    public function course()
    {
        return $this->hasOne(CourseInstructor::class, 'coach_id', 'id');
    }

    public function info()
    {
        return $this->hasOne(CoachInfo::class, 'coach_id', 'id');
    }
}
