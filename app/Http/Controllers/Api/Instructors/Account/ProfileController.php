<?php

namespace App\Http\Controllers\Api\Instructors\Account;

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
        $instructor = auth('sanctum')->user()->load('info');

        // validate request
        $validator = Validator::make($request->all(), [
            'password'      => 'min:8|max:80|string',
            'phone'         => 'regex:/^[0-9]{7,16}$/|unique:coaches,phone',
            'about'         => 'string|min:3|max:65535',
        ]);

        if ($validator->fails())
            throw new DataValidationException($validator->errors()->toArray());

        $instructor->password = $request->has('password') ? Hash::make($request->password) : $instructor->password;
        $instructor->phone = $request->phone ?? $instructor->phone;
        $instructor->info->about = $request->about ?? $instructor->info->about;
        $instructor->push(); // update data

        return $this->apiSuccessResponse();
    }
}
