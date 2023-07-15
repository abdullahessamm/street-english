<?php

namespace App\Models\Courses;

use App\Models\Coaches\Coach;
use App\Models\EnrolledStudents\EnrolledStudentForCourse;
use App\Models\Students\Student;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'courses';

    protected $fillable = [
        'course_category_id',
        'name',
        'duration',
        'level',
        'language',
        'price',
        'discount',
        'media_intro',
        'video_url',
        'image',
        'banner',
        'thumbnail',
        'description',
        'isPublished',
        'slug'
    ];

    public function instructors()
    {
        return $this->belongsToMany(Coach::class, CourseInstructor::class, 'course_id', 'coach_id');
    }

    public function contents()
    {
        return $this->hasMany(CourseContent::class, 'course_id', 'id');
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, EnrolledStudentForCourse::class, 'course_id', 'user_id');
        return $this->hasMany(EnrolledStudentForCourse::class, 'course_id', 'id');
    }

    public function category()
    {
        return $this->hasOne(CourseCategory::class, 'id', 'course_category_id');
    }

    public function getLessonsAttribute()
    {
        $lessons = collect();
        $this->contents()->with('lessons')->get()->each(function ($content) use ($lessons) {
            $content->lessons->each(function ($lesson) use ($lessons) {
                $lessons->add($lesson);
            });
        });
        return $lessons;
    }
}
