<?php

namespace App\Models\ZoomCourses;

use Illuminate\Database\Eloquent\Model;

class ZoomCourse extends Model
{
    protected $table = 'zoom_courses';

    protected $fillable = [
        'title',
        'image',
        'video',
        'description',
        'private_price_per_level',
        'group_price_per_level',
        'has_offer_for_group',
        'group_offer_levels',
        'group_offer_price',
        'has_offer_for_private',
        'private_offer_levels',
        'private_offer_price',
        'isPublished',
        'slug'
    ];

    public function levels()
    {
        return $this->hasMany(ZoomCourseLevel::class, 'zoom_course_id', 'id');
    }

    public function students() {
        return $this->belongsToMany(ZoomCourseUser::class, LiveCourseUserCourse::class, 'course_id', 'user_id')
            ->withPivot([
                'status',
                'started_at',
                'delayed_at',
                'finished_at'
            ])
            ->as('info');
    }
}
