<?php

namespace App;

use App\ModelsTraits\Accounts\NameHandler;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable
{
    use Notifiable, NameHandler, HasApiTokens;

    /*** START ABILITIES ***/
    const ABILITIES_AVAILABLE = [
        // admins
        'admins:index',
        'admins:update',
        'admins:create',
        'admins:delete',
        //recorded courses students
        'students:recordedCourses:index',
        'students:recordedCourses:update',
        'students:recordedCourses:create',
        'students:recordedCourses:delete',
        //IELTS courses students
        'students:IELTSCourses:index',
        'students:IELTSCourses:update',
        'students:IELTSCourses:create',
        'students:IELTSCourses:delete',
        //Zoom courses students
        'students:ZoomCourses:index',
        'students:ZoomCourses:update',
        'students:ZoomCourses:create',
        'students:ZoomCourses:delete',
    ];
    // admins
    CONST ABILITIES_USERS_ADMINS_INDEX  = 'admins:index';
    CONST ABILITIES_USERS_ADMINS_UPDATE = 'admins:update';
    CONST ABILITIES_USERS_ADMINS_CREATE = 'admins:create';
    CONST ABILITIES_USERS_ADMINS_DELETE = 'admins:delete';
    //recorded courses students
    CONST ABILITIES_USERS_STUDENTS_RECORDED_COURSES_INDEX   = 'students:recordedCourses:index';
    CONST ABILITIES_USERS_STUDENTS_RECORDED_COURSES_UPDATE  = 'students:recordedCourses:update';
    CONST ABILITIES_USERS_STUDENTS_RECORDED_COURSES_CREATE  = 'students:recordedCourses:create';
    CONST ABILITIES_USERS_STUDENTS_RECORDED_COURSES_DELETE  = 'students:recordedCourses:delete';
    //IELTS courses students
    CONST ABILITIES_USERS_STUDENTS_IELTS_COURSES_INDEX  = 'students:IELTSCourses:index';
    CONST ABILITIES_USERS_STUDENTS_IELTS_COURSES_UPDATE = 'students:IELTSCourses:update';
    CONST ABILITIES_USERS_STUDENTS_IELTS_COURSES_CREATE = 'students:IELTSCourses:create';
    CONST ABILITIES_USERS_STUDENTS_IELTS_COURSES_DELETE = 'students:IELTSCourses:delete';
    //Zoom courses students
    CONST ABILITIES_USERS_STUDENTS_ZOOM_COURSES_INDEX   = 'students:ZoomCourses:index';
    CONST ABILITIES_USERS_STUDENTS_ZOOM_COURSES_UPDATE  = 'students:ZoomCourses:update';
    CONST ABILITIES_USERS_STUDENTS_ZOOM_COURSES_CREATE  = 'students:ZoomCourses:create';
    CONST ABILITIES_USERS_STUDENTS_ZOOM_COURSES_DELETE  = 'students:ZoomCourses:delete';
    /*** END OF ABILITIES ***/

    protected $table = 'admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'gender',
        'email',
        'password',
        'abilities'
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

    public function getAbilities(): array
    {
        return $this->abilities ? explode(',', $this->abilities) : [];
    }

    public function setAbilities(array $abilities = null): void
    {
        if ($abilities)
            $this->abilities = implode(',', $abilities);
    }

    public function addAbility(string $ability): void
    {
        if (isset($this->abilities)) {
            if (strpos($this->abilities, $ability) === false && $this->abilities !== '*')
                $this->abilities = strlen($this->abilities) == 0 ? $ability : $this->abilities . ',' . $ability;
        }
        else
            $this->abilities = $ability;
    }

    public function removeAbility(string $ability): void
    {
        if (isset($this->abilities)) {
            $newAbilities = str_replace([
                $ability . ',',
                $ability
            ], [
                '',''
            ], $this->abilities);
            
            $this->abilities = trim($newAbilities, ',');
        }
    }
}
