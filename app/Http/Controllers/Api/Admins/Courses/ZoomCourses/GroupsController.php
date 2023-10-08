<?php

namespace App\Http\Controllers\Api\Admins\Courses\ZoomCourses;

use App\Exceptions\Authorization\UnauthorizedException;
use App\Exceptions\Models\NotFoundException;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Api\AdminDashboard\Courses\Zoom\Group\UpdateRequest;
use App\Models\ZoomCourses\ZoomCourse;
use App\Models\ZoomCourses\ZoomCourseLevelGroup;
use Illuminate\Http\JsonResponse;

class GroupsController extends ApiController
{
    /**
     * @param int $id
     * @return JsonResponse
     * @throws UnauthorizedException
     */
    public function show(int $id): JsonResponse
    {
        if (! auth('sanctum')->user()->can('index', ZoomCourse::class))
            throw new UnauthorizedException();

        return $this->apiSuccessResponse([
            'group' => ZoomCourseLevelGroup::with([
                'instructor', 'students', 'sessions'
            ])->find($id)
        ]);
    }

    /**
     * @param UpdateRequest $request
     * @param int $id
     * @return JsonResponse
     * @throws NotFoundException
     */
    public function update(UpdateRequest $request, int $id): JsonResponse
    {
        $group = ZoomCourseLevelGroup::with([
            'instructor', 'students', 'sessions'
        ])->find($id);

        if (! $group)
            throw new NotFoundException(ZoomCourseLevelGroup::class, $id);

        $reqData = collect($request->validated());

        // update group
        $group->update($reqData->only(['name', 'instructor_id'])->toArray());

        // students
        if ($reqData->has('students'))
            $group->students()->sync($reqData->get('students'));

        // sessions
        if ($reqData->has('sessions')) {
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
        }

        return $this->apiSuccessResponse([
            'group' => $group->refresh()
        ]);
    }

    /**
     * @param int $id
     * @return JsonResponse
     * @throws UnauthorizedException
     */
    public function destroy(int $id): JsonResponse
    {
        if (! auth('sanctum')->user()->can('update', ZoomCourse::class))
            throw new UnauthorizedException();

        ZoomCourseLevelGroup::where('id', $id)->delete();
        return $this->apiSuccessResponse();
    }
}
