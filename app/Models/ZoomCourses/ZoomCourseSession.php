<?php

namespace App\Models\ZoomCourses;

use App\Models\Exams\Exam;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ZoomCourseSession extends Model
{
    protected $table = 'zoom_course_sessions';

    protected $fillable = [
        'zoom_course_level_id', 'title', 'description'
    ];

    public function level(): BelongsTo
    {
        return $this->belongsTo(ZoomCourseLevel::class, 'zoom_course_level_id', 'id');
    }

    public function groupsInfo(): BelongsToMany
    {
        return $this->belongsToMany(ZoomCourseLevelGroup::class, ZoomCourseLevelGroupSession::class, 'session_id', 'group_id')
        ->using(SessionInfoPivot::class)
        ->as('info')
        ->withPivot([
            'time', 'duration', 'room_link'
        ]);
    }

    public function privatesInfo(): BelongsToMany
    {
        return $this->belongsToMany(ZoomCourseLevelPrivate::class, ZoomCourseLevelPrivateSession::class, 'session_id', 'private_id')
        ->using(SessionInfoPivot::class)
        ->as('info')
        ->withPivot([
            'time', 'duration', 'room_link'
        ]);
    }

    public function yallaNzaker(): HasMany
    {
        return $this->hasMany(YallaNzaker::class, 'session_id', 'id');
    }

    public function materials(): HasMany
    {
        return $this->hasMany(ZoomCourseSessionMaterial::class, 'session_id', 'id');
    }

    public function exercises(): BelongsToMany
    {
        return $this->belongsToMany(Exam::class, ZoomCourseSessionExercisePivot::class, 'session_id', 'exam_id')
        ->as('info')
        ->withPivot(['opened', 'title']);
    }
}
