<?php

namespace App\Models\ZoomCourses;

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

    public function privates()
    {
        return $this->hasMany(ZoomCourseLevelPrivate::class, 'live_course_user_id', 'id');
    }

    public function groups()
    {
        return $this->belongsToMany(ZoomCourseLevelGroup::class, ZoomCourseLevelGroupsUsersPivot::class, 'live_course_user_id', 'group_id')
        ->withPivot('joined_at');
    }

    public function sessionsReports()
    {
        return $this->hasMany(ZoomCourseSessionReport::class, 'student_id', 'id');
    }

    public function levelsReports()
    {
        return $this->hasMany(ZoomCourseLevelReport::class, 'student_id', 'id');
    }

    public function solvedSessionsExercises()
    {
        return $this->hasMany(ZoomCourseSessionStudentExercise::class, 'student_id', 'id');
    }
}
