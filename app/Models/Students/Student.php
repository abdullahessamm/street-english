<?php

namespace App\Models\Students;

use App\Models\Courses\Course;
use App\Models\EnrolledStudents\EnrolledStudentForCourse;
use App\ModelsTraits\Accounts\NameHandler;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use NameHandler;

    protected $table = 'users';
    
    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
        'gender',
        'phone'
    ];
    
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function courses()
    {
        return $this->belongsToMany(Course::class, EnrolledStudentForCourse::class, 'user_id');
    }
}
