<?php

namespace App\Models\Exams;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamSectionHeader extends Model
{
    use HasFactory;

    CONST AVAILABLE_TYPES = [
        'paragraph', 'picture', 'audio', 'video'
    ];

    CONST TYPE_PARAGRAPH = 'paragraph';
    CONST TYPE_PICTURE = 'picture';
    CONST TYPE_AUDIO = 'audio';
    CONST TYPE_VIDEO = 'video';

    protected $table = 'exam_section_headers';

    public $timestamps = false;

    protected $fillable = [
        'exam_section_id',
        'title',
        'type',
        'paragraph',
        'picture',
        'audio',
        'video'
    ];

    protected $hidden = [
        'picture',
        'audio',
        'video'
    ];

    public function section()
    {
        return $this->belongsTo(ExamSection::class);
    }
}
