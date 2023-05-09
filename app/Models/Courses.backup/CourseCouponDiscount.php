<?php

namespace App\Models\Courses;

use Illuminate\Database\Eloquent\Model;

class CourseCouponDiscount extends Model
{
    protected $table = 'course_coupon_discounts';

    protected $fillable = [
        'course_id', 'price', 'discount', 'coupon',
    ];

    public function belongToCourse()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }
}
