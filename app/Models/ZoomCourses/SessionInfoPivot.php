<?php

namespace App\Models\ZoomCourses;

use Illuminate\Database\Eloquent\Relations\Pivot;

class SessionInfoPivot extends Pivot
{
    protected $casts = [
        "time" => "datetime"
    ];
}
