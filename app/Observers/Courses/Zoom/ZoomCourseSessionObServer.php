<?php

namespace App\Observers\Courses\Zoom;

use App\Models\ZoomCourses\ZoomCourseLevelGroup;
use App\Models\ZoomCourses\ZoomCourseLevelPrivate;
use App\Models\ZoomCourses\ZoomCourseSession;

class ZoomCourseSessionObServer
{
    /**
     * Handle the ZoomCourseSession "created" event.
     *
     * @param  \App\Models\ZoomCourses\ZoomCourseSession  $zoomCourseSession
     * @return void
     */
    public function created(ZoomCourseSession $zoomCourseSession)
    {
        $this->syncSessionWithLevelGroups($zoomCourseSession);
        $this->syncSessionWithLevelPrivates($zoomCourseSession);
    }

    /**
     * @param ZoomCourseSession $session
     * @return void
     */
    private function syncSessionWithLevelGroups(ZoomCourseSession $session)
    {
        // get IDs of groups
        $groupsIds = ZoomCourseLevelGroup::where('zoom_course_level_id', $session->zoom_course_level_id)
            ->get(['id'])
            ->pluck('id')
            ->toArray();

        $session->groupsInfo()->sync($groupsIds);
    }

    /**
     * @param ZoomCourseSession $session
     * @return void
     */
    private function syncSessionWithLevelPrivates(ZoomCourseSession $session): void
    {
        // get IDs of groups
        $privatesIds = ZoomCourseLevelPrivate::where('zoom_course_level_id', $session->zoom_course_level_id)
            ->get(['id'])
            ->pluck('id')
            ->toArray();

        $session->privatesInfo()->sync($privatesIds);
    }
}
