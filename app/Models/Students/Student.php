<?php

namespace App\Models\Students;

use Illuminate\Support\Str;
use App\Models\Courses\Course;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use App\ModelsTraits\Accounts\NameHandler;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\EnrolledStudents\EnrolledStudentForCourse;

class Student extends Authenticatable
{
    use NameHandler, Notifiable, HasApiTokens;

    protected $table = 'users';
    
    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
        'gender',
        'phone',
        'google_id',
        'email_verified_at',
        'email_verify_token',
        'email_verify_token_expires_at',
    ];

    protected $casts = [
        'email_verify_token_expires_at' => 'datetime'
    ];
    
    protected $hidden = [
        'password',
        'remember_token',
        'email_verify_token',
        'email_verify_token_expires_at',
        'google_id',
    ];

    public function courses()
    {
        return $this->belongsToMany(Course::class, EnrolledStudentForCourse::class, 'user_id');
    }

    /**
     * generates the user's email token and save it to his db table
     *  
     * @return string $token
     */
    public function generateEmailVerifyToken()
    {
        $token = Str::random(50);
        $this->email_verify_token = Hash::make($token);
        $this->email_verify_token_expires_at = now()->addHours(2);
        $this->save();

        return $token;
    }

    public function hasEmailToken()
    {
        return !! $this->email_verify_token;
    }

    /**
     * check if email token is expired
     *
     * @return boolean
     */
    public function emailTokenExpired()
    {
        return $this->email_verify_token_expires_at->isPast();
    }

    /**
     * check if email verified
     *
     * @return void
     */
    public function emailVerified()
    {
        return !! $this->email_verified_at;
    }

    /**
     * Verify user email
     *
     * @param string $token
     * @return boolean
     */
    public function verifyEmail($token)
    {
        if (! Hash::check($token, $this->email_verify_token))
            return false;

        $this->email_verify_token = null;
        $this->email_verify_token_expires_at = null;
        $this->email_verified_at = now();
        $this->save();

        return true;
    }
}
