<?php

namespace App\Observers\Courses\Zoom;

use App\Models\ZoomCourses\ZoomCourseLevelGroup;
use App\Models\ZoomCourses\ZoomCourseSession;

class ZoomCourseLevelGroupObServer
{
    /**
     * Handle the ZoomCourseLevelGroup "created" event.
     *
     * @param  \App\Models\ZoomCourse\ZoomCourseLevelGroup  $zoomCourseLevelGroup
     * @return void
     */
    public function created(ZoomCourseLevelGroup $group)
    {
        $this->syncGroupWithLevelSession($group);
    }

    /**
     * 
     * @param ZoomCourseLevelGroup $group
     * @return void
     */
    private function syncGroupWithLevelSession(ZoomCourseLevelGroup $group): void
    {
        $sessionsIds = ZoomCourseSession::where('zoom_course_level_id', $group->zoom_course_level_id)
            ->get(['id'])
            ->pluck('id')
            ->toArray();

        $group->sessions()->sync($sessionsIds);
    }
}
