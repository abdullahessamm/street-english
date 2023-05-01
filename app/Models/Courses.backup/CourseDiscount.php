<?php

namespace App\Models\Courses;

use Illuminate\Database\Eloquent\Model;

class CourseDiscount extends Model
{
    protected $table = 'course_discounts';

    protected $fillable = [
        'course_id', 'price', 'discount'
    ];

    public function belongToCourse()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }
}
