<?php

namespace App;

use App\Models\Exercises\ExerciseUser;
use App\Models\ZoomCourses\ZoomCourseSessionUser;
use App\Notifications\LiveCourseUser\Auth\ResetPassword;
use App\Notifications\LiveCourseUser\Auth\VerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\ModelsTraits\Accounts\NameHandler;

class LiveCourseUser extends Authenticatable
{
    use Notifiable, NameHandler;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'gender', 'phone',
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

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail);
    }

    public function zoomCourseSessions()
    {
        return $this->hasMany(ZoomCourseSessionUser::class, 'zoom_course_level_user_id', 'id');
    }

    public function exercise()
    {
        return $this->hasOne(ExerciseUser::class, 'live_course_user_id', 'id');
    }

    public function info()
    {
        return $this->hasOne(LiveCourseUserInfo::class, 'live_course_user_id', 'id');
    }
}
