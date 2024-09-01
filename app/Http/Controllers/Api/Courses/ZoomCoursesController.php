<?php

namespace App\Http\Controllers\Api\Courses;

use App\Exceptions\Models\NotFoundException;
use App\Http\Controllers\Api\ApiController;
use App\Models\ZoomCourses\ZoomCourse;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ZoomCoursesController extends ApiController
{

    /**
     * Get published live courses
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $courses = ZoomCourse::where("isPublished", true)->get([
            "id",
            "title",
            "image",
            "description",
            "group_price_per_level",
        ]);

        return $this->apiSuccessResponse([
            "count" => $courses->count(),
            "courses" => $courses
        ]);
    }

    public function show(int $id)
    {
        $course = ZoomCourse::with([
            'levels' => function (HasMany $query) {
                $query->withCount('sessions');
            }
        ])->where("isPublished", true)->find($id, [
            "id",
            "title",
            "image",
            "description",
            "private_price_per_level",
            "group_price_per_level",
            "has_offer_for_private",
            "private_offer_levels",
            "private_offer_price",
            "has_offer_for_group",
            "group_offer_levels",
            "group_offer_price",
            "video"
        ]);

        $course->levels_count = $course->levels->count();
        $course->sessions_count = $course->levels->sum('sessions_count');
        unset($course->levels);

        if (! $course)
            throw new NotFoundException(ZoomCourse::class, $id);

        return $this->apiSuccessResponse([
            "course" => $course
        ]);
    }
}
