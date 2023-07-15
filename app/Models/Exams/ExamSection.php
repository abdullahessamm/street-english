<?php

namespace App\Models\Exams;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamSection extends Model
{
    use HasFactory;

    protected $table = 'exam_sections';

    protected $fillable = [
        'title', 'score'
    ];

    public function exams()
    {
        return $this->belongsToMany(Exam::class, ExamSectionPivot::class, 'exam_section_id', 'exam_id');
    }

    public function header()
    {
        return $this->hasOne(ExamSectionHeader::class);
    }

    public function questions()
    {
        return $this->hasMany(ExamSectionQuestion::class);
    }
}
