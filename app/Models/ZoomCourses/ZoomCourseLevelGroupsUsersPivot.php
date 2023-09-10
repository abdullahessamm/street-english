<?php

namespace App\Models\ZoomCourses;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZoomCourseLevelGroupsUsersPivot extends Model
{
    use HasFactory;

    protected $table = 'zoom_course_level_groups_users_pivots';
    public $timestamps = false;

    protected $fillable = [
        'group_id', 'live_course_user_id', 'joined_at'
    ];
}
