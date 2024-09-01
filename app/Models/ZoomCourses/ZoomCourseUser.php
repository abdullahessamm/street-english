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

    public function courses()
    {
        return $this->belongsToMany(ZoomCourse::class, LiveCourseUserCourse::class, 'user_id', 'course_id')
            ->withPivot([
                'status',
                'started_at',
                'delayed_at',
                'finished_at'
            ])
            ->as('info');
    }

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
        return $this->hasMany(ZoomCourseSessionReport::class, 'live_course_user_id', 'id');
    }

    public function levelsReports()
    {
        return $this->hasMany(ZoomCourseLevelReport::class, 'live_course_user_id', 'id');
    }

    public function solvedExercises()
    {
        return $this->hasMany(ZoomCourseSessionStudentExercise::class, 'student_id', 'id');
    }

    public function solvedExams()
    {
        return $this->hasMany(ZoomCourseLevelStudentExam::class, 'student_id', 'id');
    }
}
