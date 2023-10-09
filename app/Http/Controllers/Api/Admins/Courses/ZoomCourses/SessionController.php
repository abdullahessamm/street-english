<?php

namespace App\Http\Controllers\Api\Admins\Courses\ZoomCourses;

use App\Exceptions\Authorization\UnauthorizedException;
use App\Exceptions\Models\NotFoundException;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Api\AdminDashboard\Courses\Zoom\Session\UpdateRequest;
use App\Http\Requests\Api\AdminDashboard\Courses\Zoom\Session\UploadMaterialRequest;
use App\Http\Requests\Api\AdminDashboard\Courses\Zoom\Session\UploadYallaNzakerVideoRequest;
use App\Models\ZoomCourses\YallaNzaker;
use App\Models\ZoomCourses\ZoomCourse;
use App\Models\ZoomCourses\ZoomCourseSession;
use App\Models\ZoomCourses\ZoomCourseSessionMaterial;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class SessionController extends ApiController
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
            "session" => ZoomCourseSession::with([
                'exercises',
                'groupsInfo',
                'privatesInfo',
                'yallaNzaker',
                'materials',
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
        $session = ZoomCourseSession::with([
            'exercises',
            'groupsInfo',
            'privatesInfo',
            'yallaNzaker',
            'materials',
        ])->find($id);

        if (! $session)
            throw new NotFoundException(ZoomCourseSession::class, $id);

        $reqData = collect($request->validated());

        // update session
        $session->update($reqData->except('exercises')->toArray());

        // sync exercises
        if ($reqData->has('exercises')) {
            $sessionsToSync = [];

            collect($reqData->get('exercises'))->each(function ($exercise) use (&$sessionsToSync) {
                $sessionsToSync[$exercise['exam_id']] = [
                    "title"     => $exercise['title'],
                    "opened"    => $exercise['opened']
                ];
            });

            $session->exercises()->sync($sessionsToSync);
        }

        return $this->apiSuccessResponse([
            "session" => $session->refresh()
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

        ZoomCourseSession::where('id', $id)->delete();

        return $this->apiSuccessResponse();
    }

    /**
     * @param UploadMaterialRequest $request
     * @return JsonResponse
     */
    public function uploadMaterial(UploadMaterialRequest $request): JsonResponse
    {
        $reqData = collect($request->validated());

        if ($reqData->get('type') === ZoomCourseSessionMaterial::TYPE_BOOK)
            $link = $this->storeStreamToGoogle('zoom_course_sessions_materials', $request->file('book'));
        else if ($reqData->get('type') === ZoomCourseSessionMaterial::TYPE_VIEDO)
            $link = $this->storeStreamToGoogle('zoom_course_sessions_materials', $request->file('video'));
        else
            $link = $this->storeStreamToGoogle('zoom_course_sessions_materials', $request->file('audio'));

        $material = ZoomCourseSessionMaterial::create([
            "session_id"    => $reqData->get('session_id'),
            "title"         => $reqData->get('title'),
            "type"          => $reqData->get('type'),
            "link"          => $link
        ]);

        return $this->apiSuccessResponse([
            "material" => $material
        ]);
    }

    /**
     * @param int $id Material id
     * @return JsonResponse
     * @throws UnauthorizedException
     * @throws NotFoundException
     */
    public function deleteMaterial(int $id): JsonResponse
    {
        if (! auth('sanctum')->user()->can('update', ZoomCourse::class))
            throw new UnauthorizedException();

        $material = ZoomCourseSessionMaterial::find($id);
        if (! $material)
            throw new NotFoundException(ZoomCourseSessionMaterial::class, $id);

        Storage::disk('google')->delete($material->link);
        $material->delete();

        return $this->apiSuccessResponse();
    }

    /**
     * @param int $id Material id
     * @return StreamedResponse
     * @throws NotFoundException
     * @throws UnauthorizedException
     * @throws FileNotFoundException
     * @throws \League\Flysystem\FileNotFoundException
     */
    public function downloadMaterial(int $id): StreamedResponse
    {
        if (! auth('sanctum')->user()->can('index', ZoomCourse::class))
            throw new UnauthorizedException();

        $material = ZoomCourseSessionMaterial::find($id);
        if (! $material)
            throw new NotFoundException(ZoomCourseSessionMaterial::class, $id);

        $stream = Storage::disk('google')->readStream($material->link);

        return response()->stream(function () use ($stream) {
            echo stream_get_contents($stream);
        }, 200, [
            "Content-Length" => Storage::disk('google')->getMetaData($material->link)['size'],
            "Content-Type"   => $material->type === ZoomCourseSessionMaterial::TYPE_BOOK ? "application/pdf" : "application/octet-stream"
        ]);
    }

    /**
     * @param UploadYallaNzakerVideoRequest $request
     * @return JsonResponse
     */
    public function uploadYallaNzakerVideo(UploadYallaNzakerVideoRequest $request): JsonResponse
    {
        $reqData = collect($request->validated());
        $link = $this->storeStreamToGoogle('zoom_course_sessions_materials', $request->file('video'));

        return $this->apiSuccessResponse([
            'video' => YallaNzaker::create([
                'session_id' => $reqData->get('session_id'),
                "title"      => $reqData->get('title'),
                "link"       => $link
            ])
        ]);
    }

    /**
     * @param int $id
     * @return JsonResponse
     * @throws NotFoundException
     * @throws UnauthorizedException
     */
    public function deleteYallaNzakerVideo(int $id): JsonResponse
    {
        if (! auth('sanctum')->user()->can('update', ZoomCourse::class))
            throw new UnauthorizedException();

        $yallaNzakerVideo = YallaNzaker::find($id);
        if (! $yallaNzakerVideo)
            throw new NotFoundException(YallaNzaker::class, $id);

        Storage::disk('google')->delete($yallaNzakerVideo->link);
        $yallaNzakerVideo->delete();

        return $this->apiSuccessResponse();
    }

    /**
     * @param int $id
     * @return StreamedResponse
     * @throws FileNotFoundException
     * @throws NotFoundException
     * @throws UnauthorizedException
     * @throws \League\Flysystem\FileNotFoundException
     */
    public function downloadYallaNzakerVideo(int $id): StreamedResponse
    {
        if (! auth('sanctum')->user()->can('index', ZoomCourse::class))
            throw new UnauthorizedException();

        $yallaNzakerVideo = YallaNzaker::find($id);
        if (! $yallaNzakerVideo)
            throw new NotFoundException(YallaNzaker::class, $id);

        $stream = Storage::disk('google')->readStream($yallaNzakerVideo->link);

        return response()->stream(function () use ($stream) {
            echo stream_get_contents($stream);
        }, 200, [
            "Content-Length" => Storage::disk('google')->getMetaData($yallaNzakerVideo->link)['size'],
            "Content-Type"   => "application/octet-stream"
        ]);
    }
}
