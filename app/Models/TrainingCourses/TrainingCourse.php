<?php

namespace App\Models\TrainingCourses;

use App\Models\EnrolledStudents\EnrolledStudentForTrainingCourse;
use Illuminate\Database\Eloquent\Model;

class TrainingCourse extends Model
{
    protected $table = 'training_courses';

    protected $fillable = [
        'training_course_category_id', 'name', 'duration', 'level', 'language', 'price', 'discount', 'media_intro', 'video_url', 'image', 'banner', 'thumbnail', 'description', 'map', 'date', 'start_time', 'end_time', 'slug'
    ];

    public function instructors()
    {
        return $this->hasMany(TrainingCourseInstructor::class, 'training_course_id', 'id');
    }

    public function contents()
    {
        return $this->hasMany(TrainingCourseContent::class, 'training_course_id', 'id');
    }

    public function enrolledStudents()
    {
        return $this->hasMany(EnrolledStudentForTrainingCourse::class, 'training_course_id', 'id');
    }
}
