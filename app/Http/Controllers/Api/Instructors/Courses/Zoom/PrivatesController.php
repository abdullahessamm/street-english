<?php

namespace App\Http\Controllers\Api\Instructors\Courses\Zoom;

use App\Exceptions\Authorization\UnauthorizedException;
use App\Exceptions\Models\NotFoundException;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Api\InstructorDashboard\Courses\Zoom\Privates\UpdateSessionInfoRequest;
use App\Models\ZoomCourses\ZoomCourseLevelPrivate;
use Illuminate\Http\JsonResponse;

class PrivatesController extends ApiController
{
    
    /**
     * @param UpdateSessionInfoRequest $request
     * @param integer $id
     * @return JsonResponse
     * @throws NotFoundException
     * @throws UnauthorizedException
     */
    public function updateSessionsInfo(UpdateSessionInfoRequest $request, int $id): JsonResponse
    {
        $prvt = ZoomCourseLevelPrivate::with(['sessions'])->find($id);

        if (! $prvt)
            throw new NotFoundException(ZoomCourseLevelPrivate::class, $id);

        if ($prvt->instructor_id !== auth('sanctum')->user()->id)
            throw new UnauthorizedException();

        $reqData = collect($request->validated());

        // update sessions
        $reqSessions = collect($reqData->get("sessions"));
        $prvt->sessions
        ->whereIn('id', $reqSessions->pluck('id')->toArray())
        ->each(function ($session) use ($reqSessions) {
            $reqSession = $reqSessions->where('id', $session->id)->first();
            $session->info->time = $reqSession['time'] ?? $session->info->time;
            $session->info->duration = $reqSession['duration'] ?? $session->info->duration;
            $session->info->room_link = $reqSession['room_link'] ?? $session->info->room_link;
        });

        $prvt->push();

        return $this->apiSuccessResponse([
            "sessions" => $prvt->refresh()->sessions
        ]);
    }
}
