<?php

namespace App\Models\IETLSCourses;

use App\Models\EnrolledStudents\EnrolledStudentForIETLSCourse;
use App\ModelsTraits\Accounts\NameHandler;
use Illuminate\Database\Eloquent\Model;

class IeltsUser extends Model
{
    use NameHandler;

    protected $table = 'ielts_users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
        'gender',
        'phone'
    ];

    public function courses()
    {
        return $this->belongsToMany(IETLSCourse::class, EnrolledStudentForIETLSCourse::class, 'ielts_user_id', 'Ietls_course_id');
    }
}
