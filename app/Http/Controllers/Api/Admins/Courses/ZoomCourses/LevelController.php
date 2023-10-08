<?php

namespace App\Http\Controllers\Api\Admins\Courses\ZoomCourses;

use App\Exceptions\Authorization\UnauthorizedException;
use App\Exceptions\Models\NotFoundException;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Api\AdminDashboard\Courses\Zoom\Level\UpdateRequest;
use App\Models\ZoomCourses\ZoomCourse;
use App\Models\ZoomCourses\ZoomCourseLevel;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class LevelController extends ApiController
{
    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     * @throws UnauthorizedException
     */
    public function show(int $id): JsonResponse
    {
        if (! auth('sanctum')->user()->can('index', ZoomCourse::class))
            throw new UnauthorizedException();

        return $this->apiSuccessResponse([
            'level' => ZoomCourseLevel::with([
                'sessions.groupsInfo',
                'sessions.privatesInfo',
                'sessions.materials',
                'sessions.exercises',
                'groups.instructor',
                'groups.students',
                'privates.instructor',
                'privates.student',
                'exam',
            ])->find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param int $id
     * @return JsonResponse
     * @throws NotFoundException
     */
    public function update(UpdateRequest $request, int $id): JsonResponse
    {
        $level = ZoomCourseLevel::with([
            'sessions',
            'groups',
            'privates',
            'exam',
        ])->find($id);

        if (! $level)
            throw new NotFoundException(ZoomCourseLevel::class, $id);

        $reqData = collect($request->validated());

        // update level data
        $level->update($reqData->only(['title', 'description'])->toArray());

        // sessions
        if ($reqData->has('sessions')) {
            // create
            $level->sessions()->createMany($reqData->get('sessions')['create'] ?? []);

            // update
            if (isset($reqData->get('sessions')['update'])) {
                $this->updateSessions(collect($reqData->get('sessions')['update']), $level->sessions);
                $level->push();
            }

            // delete
            $level->sessions()->whereIn('id', $reqData->get('sessions')['delete'] ?? [])->delete();
        }

        // groups
        if ($reqData->has('groups')) {
            // create
            $level->groups()->createMany($reqData->get('groups')['create'] ?? []);
        }

        // privates
        if ($reqData->has('privates')) {
            // create
            $level->privates()->createMany($reqData->get('privates')['create'] ?? []);
        }

        // exam
        if ($reqData->has('exam')) {
            $examData = collect($reqData->get('exam'));
            if ($examData->has('id')) {
                $level->exam()->updateOrCreate([
                    'level_id' => $level->id
                ], [
                    'exam_id'                   => $examData->get('id'),
                    'start_at'                  => $examData->get('start_at'),
                    'student_can_start_until'   => $examData->get('student_can_start_until'),
                    'duration'                  => $examData->get('duration')
                ]);
            }
        }

        return $this->apiSuccessResponse([
            "level" => $level->refresh()->load([
                'sessions.groupsInfo',
                'sessions.privatesInfo',
                'sessions.yallaNzaker',
                'sessions.materials',
                'sessions.exercises',
                'groups.instructor',
                'groups.students',
                'privates.instructor',
                'privates.student',
                'exam',
            ])
        ]);
    }

    /**
     * @param Collection $reqSessions
     * @param Collection $levelSessions
     * @return void
     */
    private function updateSessions(Collection $reqSessions, Collection $levelSessions): void
    {
        $levelSessions
        ->whereIn('id', $reqSessions->pluck('id'))
        ->each(function ($session) use ($reqSessions) {
            $reqSession = $reqSessions->where('id', $session->id);
            $session->title = $reqSession->first()['title'] ?? $session->title;
            $session->description = isset($reqSession->first()['description']) ?
                $reqSession->first()['description'] :
                $session->description;
        });
    }
}
