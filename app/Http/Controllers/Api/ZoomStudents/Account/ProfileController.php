<?php

namespace App\Http\Controllers\Api\ZoomStudents\Account;

use App\Exceptions\Validation\DataValidationException;
use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends ApiController
{
    /**
     * @param Request $request
     * @return JsonResponse
     * @throws DataValidationException
     */
    public function update(Request $request): JsonResponse
    {
        $student = auth('sanctum')->user();

        // validate request
        $validator = Validator::make($request->all(), [
            'password'      => 'min:8|max:80|string',
            'phone'         => 'regex:/^[0-9]{7,16}$/|unique:live_course_users,phone',
        ]);

        if ($validator->fails())
            throw new DataValidationException($validator->errors()->toArray());

        $student->password = $request->has('password') ? Hash::make($request->password) : $student->password;
        $student->phone = $request->phone ?? $student->phone;
        $student->save(); // update data

        return $this->apiSuccessResponse();
    }
}
