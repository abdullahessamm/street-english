<?php

namespace App\Models\Coaches;

use App\Models\OnlineCourses\OnlineCourseInstructor;
use App\ModelsTraits\Accounts\NameHandler;
use Illuminate\Database\Eloquent\Model;

class Coach extends Model
{
    use NameHandler;

    protected $table = 'coaches';
    
    protected $fillable = [
        'name',
        'gender',
        'email',
        'phone',
        'password',
    ];

    
    protected $hidden = [
        'password', 'remember_token',
    ];

    
    public function course()
    {
        return $this->hasOne(OnlineCourseInstructor::class, 'coach_id', 'id');
    }

    public function info()
    {
        return $this->hasOne(CoachInfo::class, 'coach_id', 'id');
    }
}
