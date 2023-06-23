<?php

namespace App\Models\ZoomCourses;

use App\Models\EnrolledStudents\EnrolledStudentForZoomCourse;
use App\ModelsTraits\Accounts\NameHandler;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class ZoomCourseUser extends Authenticatable
{
    use NameHandler, Notifiable, HasApiTokens;

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

    public function courses()
    {
        return $this->belongsToMany(ZoomCourse::class, EnrolledStudentForZoomCourse::class, 'live_course_user_id');
    }
}
