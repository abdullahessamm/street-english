<?php

namespace App\Models\ZoomCourses;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YallaNzaker extends Model
{
    use HasFactory;

    protected $table = 'yalla_nzaker';

    protected $fillable = [
        'title', 'session_id', 'link'
    ];

    protected $hidden = [
        'link'
    ];
}
