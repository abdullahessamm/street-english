<?php

namespace App\Models\ZoomCourses;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZoomCourseSessionMaterial extends Model
{
    use HasFactory;

    CONST AVAILABLE_TYPES = [
        'book',
        'video',
    ];
    CONST TYPE_BOOK = 'book';
    CONST TYPE_VIEDO = 'video';

    protected $table = 'zoom_course_session_materials';
    protected $fillable = [
        'session_id',
        'type',
        'link',
    ];

    public function session()
    {
        return $this->belongsTo(ZoomCourseSession::class, 'session_id', 'id');
    }
}
