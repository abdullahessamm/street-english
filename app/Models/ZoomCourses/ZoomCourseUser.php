<?php

namespace App\Models\ZoomCourses;

use App\ModelsTraits\Accounts\NameHandler;
use Illuminate\Database\Eloquent\Model;

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
        'name',
        'gender',
        'email',
        'phone',
        'password',
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
