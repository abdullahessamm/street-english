<?php

namespace App\Models\Payments;

use App\Models\OnlineCourses\OnlineCourse;
use App\Models\Students\Student;
use Illuminate\Database\Eloquent\Model;

class OnlineCoursePayment extends Model
{
    protected $table = 'online_course_payments';

    protected $fillable = [
        'user_id', 'online_course_id', 'username', 'email', 'phone', 'country', 'payment_status',
    ];

    public function belongsToUser()
    {
        return $this->belongsTo(Student::class, 'user_id', 'id');
    }

    public function belongsToOnlineCourse()
    {
        return $this->belongsTo(OnlineCourse::class, 'online_course_id', 'id');
    }
}
