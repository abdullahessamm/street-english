<?php

namespace App\Http\Controllers\Api\Instructors\Media\Account;

use App\Exceptions\Models\NotFoundException;
use App\Exceptions\Validation\DataValidationException;
use App\Http\Controllers\Api\ApiController;
use App\Models\Coaches\Coach as Instructor;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ProfileMediaController extends ApiController
{
    /**
     * @param Request $request
     * @return JsonResponse
     * @throws DataValidationException
     */
    public function updateProfilePic(Request $request): JsonResponse
    {
        $instructor = auth('sanctum')->user()->load('info');

        // validate pic file
        $validator = Validator::make($request->all(), [
            'image' => 'file|mimes:jpg,jpeg,png,svg|max:' . config('media.max_image_size'),
        ]);

        if ($validator->fails())
            throw new DataValidationException($validator->errors()->all());

        // delete current instructor image if exists
        if ($instructor->info->image) {
            $this->deleteImageFromUrl($instructor->info->image);
            $instructor->info->image = null;
        }

        // store the new image if image has been sent
        if ($request->has('image')) {
            if ($imageUrl = $this->storeOptimizedPicture('instructors/' . $instructor->id, $request->file('image')))
                $instructor->info->image = $imageUrl;
        }

        $instructor->info->save(); // save update to database.
        return $this->apiSuccessResponse([
            'image' => $imageUrl ?? 'null'
        ]);
    }

    /**
     * @return JsonResponse|StreamedResponse
     * @throws NotFoundException
     * @throws FileNotFoundException
     * @throws \League\Flysystem\FileNotFoundException
     */
    public function downloadBioVideo(): StreamedResponse|JsonResponse
    {
        $instructor = auth('sanctum')->user()->load('info');
        if (! $instructor->info->bio_video)
            throw new NotFoundException(Instructor::class, 'bio video');

        if (request()->has('meta_data'))
            return $this->apiSuccessResponse([
                'meta_data' => Storage::disk('google')->getMetaData($instructor->info->bio_video)
            ]);

        $stream = Storage::disk('google')->readStream($instructor->info->bio_video);

        return $this->videoStreamResponse($stream);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws DataValidationException
     * @throws \League\Flysystem\FileNotFoundException
     */
    public function updateBioVideo(Request $request): JsonResponse
    {
        $instructor = auth('sanctum')->user()->load('info');
        // validate video file
        $validator = Validator::make($request->all(), [
            'video' => 'file|mimetypes:video/mpeg,video/mp4,video/webm|max:' . config('media.max_video_size'),
        ]);

        if ($validator->fails())
            throw new DataValidationException($validator->errors()->all());

        // if request doesn't contain video and instructor doesn't have saved video
        // then return success response without doing anything
        if (! $request->has('video') && ! $instructor->info->bio_video)
            return $this->apiSuccessResponse();

        // delete current instructor video if exists
        if ($instructor->info->bio_video) {
            Storage::disk('google')->delete($instructor->info->bio_video);
            $instructor->info->bio_video = null;
        }

        // store the new video if video has been sent
        if ($request->has('video'))
            $instructor->info->bio_video = $this->storeStreamToGoogle('instructors', $request->file('video'));

        $instructor->info->save(); //save update to database.

        return $this->apiSuccessResponse();
    }
}
