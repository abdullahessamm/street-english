<?php

namespace App\Http\Controllers\Api\Admins\Courses\ZoomCourses;

use App\Exceptions\Authorization\UnauthorizedException;
use App\Exceptions\Models\NotFoundException;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Api\AdminDashboard\Courses\Zoom\Privates\UpdateRequest;
use App\Models\ZoomCourses\ZoomCourse;
use App\Models\ZoomCourses\ZoomCourseLevelPrivate;
use Illuminate\Http\JsonResponse;

class PrivatesController extends ApiController
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
            'private' => ZoomCourseLevelPrivate::with([
                'instructor', 'student', 'sessions'
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
        $private = ZoomCourseLevelPrivate::with([
            'student', 'instructor', 'sessions'
        ])->find($id);

        if (! $private)
            throw new NotFoundException(ZoomCourseLevelPrivate::class, $id);

        $reqData = collect($request->validated());

        // update private
        $private->update($reqData->except('sessions')->toArray());

        // sessions
        if ($reqData->has('sessions')) {
            $reqSessions = collect($reqData->get("sessions"));
            $private->sessions
            ->whereIn('id', $reqSessions->pluck('id')->toArray())
            ->each(function ($session) use ($reqSessions) {
                $reqSession = $reqSessions->where('id', $session->id)->first();
                $session->info->time = $reqSession['time'] ?? $session->info->time;
                $session->info->duration = $reqSession['duration'] ?? $session->info->duration;
                $session->info->room_link = $reqSession['room_link'] ?? $session->info->room_link;
            });

            $private->push();
        }

        return $this->apiSuccessResponse([
            "private" => $private->refresh()
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

        ZoomCourseLevelPrivate::where('id', $id)->delete();
        return $this->apiSuccessResponse();
    }
}

