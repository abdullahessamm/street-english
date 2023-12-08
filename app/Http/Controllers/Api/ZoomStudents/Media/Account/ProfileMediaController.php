<?php

namespace App\Http\Controllers\Api\ZoomStudents\Media\Account;

use App\Exceptions\Validation\DataValidationException;
use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProfileMediaController extends ApiController
{
    /**
     * @param Request $request
     * @return JsonResponse
     * @throws DataValidationException
     */
    public function updateProfilePic(Request $request): JsonResponse
    {
        $student = auth('sanctum')->user();

        // validate pic file
        $validator = Validator::make($request->all(), [
            'image' => 'file|mimes:jpg,jpeg,png,svg|max:' . config('media.max_image_size'),
        ]);

        if ($validator->fails())
            throw new DataValidationException($validator->errors()->all());

        // delete current student's image if exists
        if ($student->image) {
            $this->deleteImageFromUrl($student->image);
            $student->image = null;
        }

        // store the new image if image has been sent
        if ($request->has('image')) {
            if ($imageUrl = $this->storeImage('zoom-course-users/' . $student->id, $request->file('image')))
                $student->image = $imageUrl;
        }

        $student->save(); // save update to database.
        return $this->apiSuccessResponse([
            'image' => $imageUrl ?? null
        ]);
    }
}
