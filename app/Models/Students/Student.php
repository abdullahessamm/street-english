<?php

namespace App\Models\Students;

use App\Models\EnrolledStudents\EnrolledStudentForOnlineCourse;
use App\ModelsTraits\Accounts\NameHandler;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use NameHandler;

    protected $table = 'users';
    
    protected $fillable = [
        'name', 'email', 'password', 'image', 'gender', 'phone'
    ];
    
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function course()
    {
        return $this->hasOne(EnrolledStudentForOnlineCourse::class, 'user_id', 'id');
    }
}
