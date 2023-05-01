<?php

namespace App;

use App\Models\EnrolledStudents\EnrolledStudentForCourse;
use App\Models\Courses\Course;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'image',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function course($course_id)
    {
        return $this->hasOne(EnrolledStudentForCourse::class, 'user_id', 'id')->where('course_id', $course_id)->first();
    }

    public function info()
    {
        return $this->hasOne(UserInfo::class, 'user_id', 'id');
    }
}
