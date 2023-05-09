<?php

namespace App\Models\Bundles;

use App\Models\Courses\Course;
use Illuminate\Database\Eloquent\Model;

class BundleCourse extends Model
{
    protected $table = 'bundle_courses';

    protected $fillable = [ 
        'bundle_id', 'course_id',
    ];

    public function belongsToCourse()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }
}
