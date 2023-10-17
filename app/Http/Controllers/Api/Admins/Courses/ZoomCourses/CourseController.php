<?php

namespace App\Http\Controllers\Api\Admins\Courses\ZoomCourses;

use App\Exceptions\Authorization\UnauthorizedException;
use App\Exceptions\Models\NotFoundException;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Api\AdminDashboard\Courses\Zoom\Course\StoreRequest;
use App\Http\Requests\Api\AdminDashboard\Courses\Zoom\Course\UpdateImageRequest;
use App\Http\Requests\Api\AdminDashboard\Courses\Zoom\Course\UpdateIntroVideoRequest;
use App\Http\Requests\Api\AdminDashboard\Courses\Zoom\Course\UpdateRequest;
use App\Http\Requests\PaginationRequest;
use App\Models\ZoomCourses\ZoomCourse;
use Illuminate\Http\JsonResponse;

class CourseController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @param PaginationRequest $request
     * @return JsonResponse
     * @throws UnauthorizedException
     */
    public function index(PaginationRequest $request): JsonResponse
    {
        if (! auth('sanctum')->user()->can('index', ZoomCourse::class))
            throw new UnauthorizedException();

        $paginateQueries = collect($request->validated());

        return $this->apiSuccessResponse([
            'courses' => ZoomCourse::with('levels')
                ->orderBy('created_at', 'DESC')
                ->paginate($paginateQueries->get('per_page'), ['*'], 'page', $paginateQueries->get('page'))
                ->all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return JsonResponse
     * @throws UnauthorizedException
     */
    public function store(StoreRequest $request): JsonResponse
    {
        if (! auth('sanctum')->user()->can('create', ZoomCourse::class))
            throw new UnauthorizedException();

        $reqData = collect($request->validated());
        $reqData->put('slug', $reqData->get('title'));
        $course = ZoomCourse::create($reqData->except('levels')->toArray());
        $course->levels()->createMany($reqData->get('levels'));

        return $this->apiSuccessResponse([
            'course' => $course->load('levels')
        ]);
    }

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
            'course' => ZoomCourse::with([
                'levels.sessions.groupsInfo',
                'levels.sessions.privatesInfo',
                'levels.sessions.yallaNzaker',
                'levels.sessions.materials',
                'levels.sessions.exercises',
                'levels.groups.instructor:id,name',
                'levels.groups.instructor.info:coach_id,image',
                'levels.groups.students:id,name,image',
                'levels.groups.sessions',
                'levels.privates.instructor:id,name',
                'levels.privates.instructor.info:coach_id,image',
                'levels.privates.student:id,name,image',
                'levels.privates.sessions',
                'levels.exam.content:id,name,full_mark',
            ])->find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param int $id
     * @return JsonResponse
     * @throws UnauthorizedException|NotFoundException
     */
    public function update(UpdateRequest $request, int $id): JsonResponse
    {
        if (! auth('sanctum')->user()->can('update', ZoomCourse::class))
            throw new UnauthorizedException();

        $course = ZoomCourse::with('levels')->find($id);
        if (! $course)
            throw new NotFoundException(ZoomCourse::class, $id);

        // request data
        $reqData = collect($request->validated());

        // update course
        $course->update($reqData->except('levels')->toArray());

        // handle levels changes
        if ($reqData->has('levels')) {
            // update levels and save course
            $this->updateLevels($course, $reqData->get('levels')['update'] ?? []);
            $course->push();

            // delete levels
            $course->levels()->whereIn('id', $reqData->get('levels')['delete'] ?? [])->delete();

            // create new levels
            $course->levels()->createMany($reqData->get('levels')['create'] ?? []);
        }

        return $this->apiSuccessResponse([
            'course' => $course->refresh()
        ]);
    }

    /**
     * update zoom course's levels (witout commit update to database)
     *
     * @param ZoomCourse $course
     * @param array $levels
     * @return void
     */
    private function updateLevels(ZoomCourse $course, array $levels): void
    {
        $levels = collect($levels);

        $course->levels->each(function ($courseLevel) use ($levels) {
            if ($reqLevel = $levels->where('id', $courseLevel->id)->first()) {
                $courseLevel->title = $reqLevel['title'] ?? $courseLevel->title;
                $courseLevel->description = isset($reqLevel['description']) ? $reqLevel['description'] : $courseLevel->description;
            } // end of if
        }); // end of each
    }

    /**
     * Undocumented function
     *
     * @param UpdateImageRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function updateThumbnail(UpdateImageRequest $request, $id)
    {
        if (! auth('sanctum')->user()->can('update', ZoomCourse::class))
            throw new UnauthorizedException();

        $course = ZoomCourse::find($id);
        if (! $course)
            throw new NotFoundException(ZoomCourse::class, $id);

        // delete saved image
        if ($course->image) {
            $this->deleteImageFromUrl($course->image);
            $course->image = null;
        }

        // save new one if exists
        $reqData = $request->validated();
        if (isset($reqData['image']))
            $course->image = $this->storeImage('courses/zoom/thumbnails', $reqData['image']) ?? null;

        // update course
        $course->save();

        return $this->apiSuccessResponse();
    }

    public function updateIntroVideo(UpdateIntroVideoRequest $request, $id)
    {
        if (! auth('sanctum')->user()->can('update', ZoomCourse::class))
            throw new UnauthorizedException();

        $course = ZoomCourse::find($id);
        if (! $course)
            throw new NotFoundException(ZoomCourse::class, $id);

        // delete saved video
        if ($course->video) {
            $this->deletePublicFileFromUrl($course->video);
            $course->video = null;
        }

        // save new one if exists
        $reqData = $request->validated();
        if (isset($reqData['video']))
            $course->video = $this->storePublicVideo('courses/zoom/videos', $reqData['video']) ?? null;

        // update course
        $course->save();

        return $this->apiSuccessResponse();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! auth('sanctum')->user()->can('delete', ZoomCourse::class))
            throw new UnauthorizedException();

        ZoomCourse::where('id', $id)->delete();

        return $this->apiSuccessResponse();
    }
}
