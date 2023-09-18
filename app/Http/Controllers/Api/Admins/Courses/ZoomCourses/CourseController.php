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

class CourseController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PaginationRequest $request)
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! auth('sanctum')->user()->can('index', ZoomCourse::class))
            throw new UnauthorizedException();

        return $this->apiSuccessResponse([
            'course' => ZoomCourse::with([
                'levels.sessions.materials',
                'levels.sessions.exercises',
                'levels.groups.instructor',
                'levels.privates.instructor',
                'levels.exam',
            ])->find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        if (! auth('sanctum')->user()->can('update', ZoomCourse::class))
            throw new UnauthorizedException();

        $course = ZoomCourse::with('levels')->find($id);
        if (! $course)
            throw new NotFoundException(ZoomCourse::class, $id);

        $reqData = collect($request->validated());
        // update course
        $course->title = $reqData->get('title') ?? $course->title;
        $course->description = $reqData->get('description') ?? $course->description;
        $course->private_price = $reqData->get('private_price') ?? $course->private_price;
        $course->private_price_per_level = $reqData->get('private_price_per_level') ?? $course->private_price_per_level;
        $course->group_price = $reqData->get('group_price') ?? $course->group_price;
        $course->group_price_per_level = $reqData->get('group_price_per_level') ?? $course->group_price_per_level;
        $course->isPublished = $reqData->has('isPublished') ? $reqData->get('isPublished') : $course->isPublished;

        if ($reqData->has('levels')) {
            // update levels and save course
            $this->updateLevels($course, $reqData->get('levels')['update'] ?? []);
            $course->push();

            // delete levels
            $course->levels()->whereIn('id', $reqData->get('levels')['delete'] ?? [])->delete();

            // create new levels
            $course->levels()->createMany($reqData->get('levels')['create'] ?? []);
        } else
            $course->save();


        return $this->apiSuccessResponse([
            'course' => $course->refresh()
        ]);
    }

    /**
     * update zoom course's levels (witout commit update to database)
     *
     * @param ZoomCourse $course
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
