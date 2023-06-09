<?php

namespace App\Models\Students;

use App\Models\Bundles\BundleUser;
use App\Models\EnrolledStudents\EnrolledStudentForOnlineCourse;
use Illuminate\Database\Eloquent\Model;
use App\ModelsTraits\Accounts\NameHandler;

class Student extends Model
{
    use NameHandler;

    protected $table = 'users';
    
    protected $fillable = [
        'name', 'email', 'password', 'image', 'gender', 'phone',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function course()
    {
        return $this->hasOne(EnrolledStudentForOnlineCourse::class, 'user_id', 'id');
    }

    public function bundle()
    {
        return $this->hasOne(BundleUser::class, 'user_id', 'id');
    }
}
