<?php

namespace App\Observers\Courses\Zoom;

use App\Models\ZoomCourses\ZoomCourseLevelPrivate;
use App\Models\ZoomCourses\ZoomCourseSession;

class ZoomCourseLevelPrivateObServer
{
    /**
     * Handle the ZoomCourseLevelPrivate "created" event.
     *
     * @param  \App\Models\ZoomCourses\ZoomCourseLevelPrivate  $zoomCourseLevelPrivate
     * @return void
     */
    public function created(ZoomCourseLevelPrivate $private)
    {
        $this->syncPrivateWithLevelSession($private);
    }

    private function syncPrivateWithLevelSession(ZoomCourseLevelPrivate $private): void
    {
        $sessionsIds = ZoomCourseSession::where('zoom_course_level_id', $private->zoom_course_level_id)
            ->get(['id'])
            ->pluck('id')
            ->toArray();

        $private->sessions()->sync($sessionsIds);
    }
}
