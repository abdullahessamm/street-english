<?php

namespace App\Models\Exams;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamSectionPivot extends Model
{
    use HasFactory;

    protected $table = 'exam_sections_pivot';

    protected $fillable = [
        'exam_id', 'exam_section_id', 'order'
    ];
}
