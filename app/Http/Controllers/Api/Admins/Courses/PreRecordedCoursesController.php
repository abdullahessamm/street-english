<?php

namespace App\Http\Controllers\Api\Admins\Courses;

use App\Exceptions\Authorization\UnauthorizedException;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\PaginationRequest;
use App\Utils\GoogleDriveHelpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

abstract class PreRecordedCoursesController extends ApiController
{
    /**
     * get course model
     *
     * @return Model
     */
    abstract protected function getModel(): Model;

    /**
     * get form request
     *
     * @return FormRequest
     */
    abstract protected function storeRules(): array;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PaginationRequest $request)
    {
        if (! auth('sanctum')->user()->can('index', get_class($this->getModel())))
            throw new UnauthorizedException();

        $paginateQueries = (object) $request->validated();
        return $this->apiSuccessResponse([
            'courses' => $this->getModel()
                ->orderBy('created_at', 'DESC')
                ->paginate($paginateQueries->per_page ?? null, ['*'], null, $paginateQueries->page ?? null)
                ->all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // check policy
        if (! auth('sanctum')->user()->can('create', get_class($this->getModel())))
            throw new UnauthorizedException();

        $request->validate($this->storeRules()); // validate request
        $data = $request->except(['video', 'image', 'thumbnail']);
        
        $modelInstance = $this->getModel(); // get course's model instance

        // assign validated request's attribute to model instance
        foreach ($data as $key => $val)
            $modelInstance[$key] = $val;

        // store thumbnail to public storage and assign it's url to instance
        if ($thumbnailUrl = $this->storeImage('courses/thumbnails', $request->file('thumbnail')))
            $modelInstance->thumbnail = $thumbnailUrl;

        // store intro image if exists
        if ($request->has('image')) {
            if ($imageUrl = $this->storeImage('courses/intro/images', $request->file('image')))
                $modelInstance->image = $imageUrl;
        }

        // store video if exists
        if ($request->has('video')) {
            $dir = GoogleDriveHelpers::createDirIfNotExists('coursesIntroVideos');
            $file = $request->file('video')->store($dir['path'], ['disk' => 'google']);
            $filePath = Storage::disk('google')->getMetaData($file)['path'];
            $modelInstance->video_url = $filePath;
        }

        $modelInstance->slug = $request->name;
        $modelInstance->save(); // save to database

        return $this->apiSuccessResponse([
            'course' => $modelInstance
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
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
