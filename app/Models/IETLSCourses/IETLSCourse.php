<?php

namespace App\Models\IETLSCourses;

use App\Models\Coaches\Coach;
use App\Models\EnrolledStudents\EnrolledStudentForCourse;
use App\Models\EnrolledStudents\EnrolledStudentForIETLSCourse;
use Illuminate\Database\Eloquent\Model;

class IETLSCourse extends Model
{
    protected $table = 'Ietls_courses';

    protected $fillable = [
        'Ietls_course_category_id',
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
        return $this->belongsToMany(Coach::class, IETLSCourseInstructor::class, 'Ietls_course_id', 'coach_id');
    }

    public function contents()
    {
        return $this->hasMany(IETLSCourseContent::class, 'Ietls_course_id', 'id');
    }

    public function students()
    {
        return $this->belongsToMany(IeltsUser::class, EnrolledStudentForIETLSCourse::class, 'Ietls_course_id', 'ielts_user_id');
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
