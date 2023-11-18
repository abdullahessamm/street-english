<?php

namespace App\Http\Controllers\Api\Instructors\Courses\Zoom;

use App\Exceptions\Authorization\UnauthorizedException;
use App\Exceptions\Models\NotFoundException;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Api\InstructorDashboard\Courses\Zoom\Groups\UpdateSessionInfoRequest;
use App\Models\ZoomCourses\ZoomCourseLevelGroup;
use Illuminate\Http\JsonResponse;

class GroupsController extends ApiController
{

    /**
     * @param UpdateSessionInfoRequest $request
     * @param integer $groupId
     * @return JsonResponse
     * @throws NotFoundException
     * @throws UnauthorizedException
     */
    public function updateSessionsInfo(UpdateSessionInfoRequest $request, int $groupId): JsonResponse
    {
        $group = ZoomCourseLevelGroup::with(['sessions'])->find($groupId);
        // throw error if group not found
        if (! $group)
            throw new NotFoundException(ZoomCourseLevelGroup::class, $groupId);
        // check if instructor has access to group
        if ($group->instructor_id !== auth('sanctum')->user()->id)
            throw new UnauthorizedException();
        
        $reqData = collect($request->validated());

        // update sessions
        $reqSessions = collect($reqData->get("sessions"));
        $group->sessions
        ->whereIn('id', $reqSessions->pluck('id')->toArray())
        ->each(function ($session) use ($reqSessions) {
            $reqSession = $reqSessions->where('id', $session->id)->first();
            $session->info->time = $reqSession['time'] ?? $session->info->time;
            $session->info->duration = $reqSession['duration'] ?? $session->info->duration;
            $session->info->room_link = $reqSession['room_link'] ?? $session->info->room_link;
        });

        $group->push();

        return $this->apiSuccessResponse([
            "sessions" => $group->refresh()->sessions
        ]);
    }
}
