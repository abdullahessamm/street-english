<?php

namespace App;

use App\Models\Coaches\Sessions\CoachSession;
use App\Models\Coaches\Sessions\CoachSessionAppointment;
use App\Models\Coaches\Sessions\CoachSessionDate;
use App\Models\Courses\CourseInstructor;
use App\Notifications\Coach\Auth\ResetPassword;
use App\Notifications\Coach\Auth\VerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Coach extends Authenticatable
{
    use Notifiable;

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

    public function info()
    {
        return $this->hasOne(CoachInfo::class, 'coach_id', 'id');
    }

    public function courses()
    {
        return $this->hasMany(CourseInstructor::class, 'coach_id', 'id');
    }

    public function sessions()
    {
        return $this->hasMany(CoachSession::class, 'coach_id', 'id');
    }

    public function dates()
    {
        return $this->hasManyThrough(CoachSessionDate::class, CoachSession::class);
    }
}
