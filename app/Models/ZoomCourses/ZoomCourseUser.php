<?php

namespace App\Models\ZoomCourses;

use Illuminate\Database\Eloquent\Model;
use App\ModelsTraits\Accounts\NameHandler;

class ZoomCourseUser extends Model
{
    use NameHandler;

    protected $table = 'live_course_users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'gender', 'phone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function info()
    {
        return $this->hasOne(ZoomCourseUserInfo::class, 'live_course_user_id', 'id');
    }
}
