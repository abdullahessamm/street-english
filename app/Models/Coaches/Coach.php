<?php

namespace App\Models\Coaches;

use App\Models\Coaches\Blogs\CoachPost;
use App\Models\Courses\Course;
use App\Models\Courses\CourseInstructor;
use App\Models\IETLSCourses\IETLSCourse;
use App\Models\IETLSCourses\IETLSCourseInstructor;
use App\Models\ZoomCourses\ZoomCourse;
use App\Models\ZoomCourses\ZoomCourseInstructor;
use App\ModelsTraits\Accounts\NameHandler;
use Illuminate\Database\Eloquent\Model;

class Coach extends Model
{
    use NameHandler;

    protected $table = 'coaches';
    
    protected $fillable = [
        'name',
        'gender',
        'email',
        'phone',
        'password',
    ];

    
    protected $hidden = [
        'password', 'remember_token',
    ];

    
    public function recordedCourses()
    {
        return $this->belongsToMany(Course::class, CourseInstructor::class);
    }

    public function ieltsCourses()
    {
        return $this->belongsToMany(IETLSCourse::class, IETLSCourseInstructor::class, 'coach_id', 'Ietls_course_id');
    }

    public function zoomCourses()
    {
        return $this->belongsToMany(ZoomCourse::class, ZoomCourseInstructor::class);
    }

    public function info()
    {
        return $this->hasOne(CoachInfo::class);
    }

    public function posts()
    {
        return $this->hasMany(CoachPost::class);
    }
}
