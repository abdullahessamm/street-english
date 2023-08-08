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
        // statistics
        'statistics:plots',
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
        // Instructors
        'instructors:index',
        'instructors:update',
        'instructors:create',
        'instructors:delete',
        // Recorded courses
        'courses:recorded:index',
        'courses:recorded:update',
        'courses:recorded:create',
        'courses:recorded:delete',
        // Zoom courses
        'courses:zoom:index',
        'courses:zoom:update',
        'courses:zoom:create',
        'courses:zoom:delete',
        // IETLS courses
        'courses:ielts:index',
        'courses:ielts:update',
        'courses:ielts:create',
        'courses:ielts:delete',
        // Exams
        'exams:index',
        'exams:update',
        'exams:create',
        'exams:delete',
    ];
    // statistics
    CONST ABILITIES_STATISTICS_PLOTS = 'statistics:plots';
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
    //Instructors
    CONST ABILITIES_USERS_INSTRUCTORS_INDEX   = 'instructors:index';
    CONST ABILITIES_USERS_INSTRUCTORS_UPDATE  = 'instructors:update';
    CONST ABILITIES_USERS_INSTRUCTORS_CREATE  = 'instructors:create';
    CONST ABILITIES_USERS_INSTRUCTORS_DELETE  = 'instructors:delete';
    // recorded courses
    CONST ABILITIES_COURSES_RECORDED_INDEX   = 'courses:recorded:index';
    CONST ABILITIES_COURSES_RECORDED_UPDATE  = 'courses:recorded:update';
    CONST ABILITIES_COURSES_RECORDED_CREATE  = 'courses:recorded:create';
    CONST ABILITIES_COURSES_RECORDED_DELETE  = 'courses:recorded:delete';
    // Zoom courses
    CONST ABILITIES_COURSES_ZOOM_INDEX   = 'courses:zoom:index';
    CONST ABILITIES_COURSES_ZOOM_UPDATE  = 'courses:zoom:update';
    CONST ABILITIES_COURSES_ZOOM_CREATE  = 'courses:zoom:create';
    CONST ABILITIES_COURSES_ZOOM_DELETE  = 'courses:zoom:delete';
    // IELTS courses
    CONST ABILITIES_COURSES_IELTS_INDEX   = 'courses:ielts:index';
    CONST ABILITIES_COURSES_IELTS_UPDATE  = 'courses:ielts:update';
    CONST ABILITIES_COURSES_IELTS_CREATE  = 'courses:ielts:create';
    CONST ABILITIES_COURSES_IELTS_DELETE  = 'courses:ielts:delete';
    // Exams
    CONST ABILITIES_EXAMS_INDEX   = 'exams:index';
    CONST ABILITIES_EXAMS_UPDATE  = 'exams:update';
    CONST ABILITIES_EXAMS_CREATE  = 'exams:create';
    CONST ABILITIES_EXAMS_DELETE  = 'exams:delete';
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

    public function hasAbility(string $ability): bool
    {
        return in_array($ability, $this->getAbilities()) || in_array('*', $this->getAbilities());
    }
}
