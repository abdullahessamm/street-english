<?php

namespace App;

use App\Models\EnrolledStudents\EnrolledStudentForIETLSCourse;
use App\Notifications\IeltsUser\Auth\ResetPassword;
use App\Notifications\IeltsUser\Auth\VerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\ModelsTraits\Accounts\NameHandler;

class IeltsUser extends Authenticatable
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

    public function course($course_id)
    {
        return $this->hasOne(EnrolledStudentForIETLSCourse::class, 'ielts_user_id', 'id')->where('Ietls_course_id', $course_id)->first();
    }
}
