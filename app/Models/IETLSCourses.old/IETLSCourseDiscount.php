<?php

namespace App\Models\IETLSCourses;

use Illuminate\Database\Eloquent\Model;

class IETLSCourseDiscount extends Model
{
    protected $table = 'ietls_course_discounts';

    protected $fillable = [
        'ietls_course_id', 'price', 'discount'
    ];

    public function belongToCourse()
    {
        return $this->belongsTo(IETLSCourse::class, 'ietls_course_id', 'id');
    }
}
