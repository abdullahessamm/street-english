<?php

namespace App\Http\Controllers\Api\Instructors\Media\Courses;

use App\Exceptions\Authorization\UnauthorizedException;
use App\Exceptions\Models\NotFoundException;
use App\Http\Controllers\Api\ApiController;
use App\Models\Exams\ExamSection;
use App\Models\Exams\ExamSectionHeader;
use App\Models\ZoomCourses\ZoomCourseSessionMaterial;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ZoomMediaController extends ApiController
{
    /**
     * @param int $sectionId
     * @return JsonResponse|StreamedResponse
     * @throws FileNotFoundException
     * @throws \League\Flysystem\FileNotFoundException
     * @throws NotFoundException
     */
    public function ExamSectionHeaderMedia(int $sectionId): StreamedResponse|JsonResponse
    {
        $section = ExamSection::with('header')->find($sectionId);
        if (! $section)
            throw new NotFoundException(ExamSection::class, $sectionId);

        $stream = null;
        $metaData = [];

        switch ($section->header?->type) {
            case ExamSectionHeader::TYPE_PICTURE:
                $stream = Storage::disk('google')->readStream($section->header->picture);
                $metaData = Storage::disk('google')->getMetaData($section->header->picture);
                break;

            case ExamSectionHeader::TYPE_AUDIO:
                $stream = Storage::disk('google')->readStream($section->header->audio);
                $metaData = Storage::disk('google')->getMetaData($section->header->audio);
                break;

            case ExamSectionHeader::TYPE_VIDEO:
                $stream = Storage::disk('google')->readStream($section->header->video);
                $metaData = Storage::disk('google')->getMetaData($section->header->video);
                break;

            default:
                return response()->json([
                    'success' => false,
                    'message' => 'No media found.'
                ], Response::HTTP_NOT_FOUND);
        } // end of switch

        return response()->stream(function () use ($stream) {
            echo stream_get_contents($stream);
        }, 200, [
            'Content-Type' => 'application/octet-stream',
            'Content-Length' => $metaData['size']
        ]);
    }

    /**
     * @param int $materialId
     * @return StreamedResponse
     * @throws FileNotFoundException
     * @throws NotFoundException
     * @throws UnauthorizedException
     * @throws \League\Flysystem\FileNotFoundException
     */
    public function sessionMaterial(int $materialId): StreamedResponse
    {
        $material = ZoomCourseSessionMaterial::find($materialId);
        if (! $material)
            throw new NotFoundException(ZoomCourseSessionMaterial::class, $materialId);

        // check if instructor has rights to access material
        $canAccess = $material->session()->whereHas('level.groups', function (Builder $q) {
                $q->where('instructor_id', auth('sanctum')->user()->id);
            })->count() > 0 ||
            $material->session()->whereHas('level.privates', function (Builder $q) {
                $q->where('instructor_id', auth('sanctum')->user()->id);
            })->count() > 0;

        if (! $canAccess)
            throw new UnauthorizedException();

        $stream = Storage::disk('google')->readStream($material->link);

        return response()->stream(function () use ($stream) {
            echo stream_get_contents($stream);
        }, 200, [
            "Content-Length" => Storage::disk('google')->getMetaData($material->link)['size'],
            "Content-Type"   => $material->type === ZoomCourseSessionMaterial::TYPE_BOOK ? "application/pdf" : "application/octet-stream"
        ]);
    }
}
