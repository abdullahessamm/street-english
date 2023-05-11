<?php

namespace App\Models\IETLSCourses;

use Illuminate\Database\Eloquent\Model;

class IETLSCourseCouponDiscount extends Model
{
    protected $table = 'ietls_course_coupon_discounts';

    protected $fillable = [
        'ietls_course_id', 'price', 'discount', 'coupon',
    ];

    public function belongToCourse()
    {
        return $this->belongsTo(IETLSCourse::class, 'ietls_course_id', 'id');
    }
}
