<?php

namespace App\Models\TrainingCourses;

use Illuminate\Database\Eloquent\Model;

class TrainingCourseContent extends Model
{
    protected $table = 'training_course_contents';

    protected $fillable = [
        'training_course_id', 'title', 'description',
    ];
    
    public function belongsToTrainingCourse()
    {
        return $this->belongsTo(TrainingCourse::class, 'training_course_id', 'id');
    }
}
