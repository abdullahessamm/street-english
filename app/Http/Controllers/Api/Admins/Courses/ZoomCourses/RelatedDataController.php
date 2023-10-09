<?php

namespace App\Http\Controllers\Api\Admins\Courses\ZoomCourses;

use App\Exceptions\Authorization\UnauthorizedException;
use App\Http\Controllers\Api\ApiController;
use App\Models\Coaches\Coach;
use App\Models\Exams\Exam;
use App\Models\ZoomCourses\ZoomCourse;
use App\Models\ZoomCourses\ZoomCourseUser;
use Illuminate\Http\JsonResponse;

class RelatedDataController extends ApiController
{

    /**
     * @return JsonResponse
     * @throws UnauthorizedException
     */
    public function instructors(): JsonResponse
    {
        $this->authorizeUser();

        return $this->apiSuccessResponse([
            "instructors" => Coach::with('info:coach_id,image')->get(['id', 'name'])
        ]);
    }

    /**
     * @return JsonResponse
     * @throws UnauthorizedException
     */
    public function students(): JsonResponse
    {
        $this->authorizeUser();

        return $this->apiSuccessResponse([
            "students" => ZoomCourseUser::get(['id', 'name', 'image'])
        ]);
    }

    /**
     * @return JsonResponse
     * @throws UnauthorizedException
     */
    public function exams(): JsonResponse
    {
        $this->authorizeUser();

        return $this->apiSuccessResponse([
            "exams" => Exam::get(['id', 'name', 'full_mark'])
        ]);
    }

    /**
     * @return void
     * @throws UnauthorizedException
     */
    private function authorizeUser(): void
    {
        if (auth('sanctum')->user()->cannot('index', ZoomCourse::class))
            throw new UnauthorizedException();
    }
}
