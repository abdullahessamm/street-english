<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\AdminDashboard\AppConfig\LandingPage\LandingPageUpdateRequest;
use App\Http\Requests\Api\AdminDashboard\AppConfig\LandingPage\UploadCoverVideoRequest;
use App\Http\Requests\Api\AdminDashboard\AppConfig\LandingPage\UploadTestimonialStudentImageRequest;
use App\Models\AppConfig;
use App\Models\ZoomCourses\ZoomCourse;
use Illuminate\Http\JsonResponse;

class AppConfigDataController extends ApiController
{

    /**
     * Index landing page configuration data
     *
     * @return JsonResponse
     */
    public function getLandingPageConfigData(): JsonResponse
    {
        $landingPageData = AppConfig::findOrFail('landing_page')?->value;
        $courses = ZoomCourse::whereIn('id', $landingPageData['most_popular_courses_ids'])
            ->where('isPublished', true)
            ->get([
                'title', 'image', 'description', 'group_price_per_level'
            ]);
        // delete ids of courses
        unset($landingPageData['most_popular_courses_ids']);
        // assign most popular courses
        $landingPageData['most_popular_courses'] = $courses;

        return $this->apiSuccessResponse([
            'data' => $landingPageData
        ]);
    }

    /**
     * Updates the options of landing page
     *
     * @param LandingPageUpdateRequest $request
     * @return JsonResponse
     */
    public function updateLandingPageConfigData(LandingPageUpdateRequest $request): JsonResponse
    {
        $landingPageRow = AppConfig::findOrFail('landing_page');
        $landingPageConfig = $landingPageRow->value;

        foreach ($request->validated() as $optionKey => $optionValue)
            $landingPageConfig[$optionKey] = $optionValue;

        $landingPageRow->value = $landingPageConfig;
        $landingPageRow->save();

        return $this->apiSuccessResponse();
    }

    public function uploadCoverVideo(UploadCoverVideoRequest  $request)
    {
        return $this->apiSuccessResponse();
    }

    /**
     * Updates the testimonials avatars
     * @param UploadTestimonialStudentImageRequest $request
     * @return JsonResponse
     */
    public function uploadTestimonialStudentImage(UploadTestimonialStudentImageRequest $request)
    {
        $landingPageRow = AppConfig::findOrFail('landing_page');
        $landingPageConfig = $landingPageRow->value;
        $testimonials = collect($landingPageConfig['testimonials']);
        $targetTestimonial = $testimonials->where('id', $request->id)->first();
        $targetTestimonialIndex = $testimonials->search($targetTestimonial);

        // return false response if testimonial not found
        if (! $targetTestimonial)
            return response()->json([
                'success' => false,
                'message' => 'Testimonial not found'
            ], 404);

        // delete avatar if exists
        if (isset($targetTestimonial['avatar'])) {
            $this->deleteImageFromUrl($targetTestimonial['avatar']);
            unset($targetTestimonial['avatar']);
        }

        // save uploaded image
        if ($request->hasFile('image')) {
            $avatarLink = $this->storeImage('landing_page/testimonials', $request->file('image'));
            $targetTestimonial['avatar'] = $avatarLink;
        }

        // update the testimonials with new data
        $landingPageConfig['testimonials'] = $testimonials->replace([
            $targetTestimonialIndex => $targetTestimonial
        ]);

        // save to database
        $landingPageRow->value = $landingPageConfig;
        $landingPageRow->save();

        return $this->apiSuccessResponse([
            'link' => $avatarLink ?? null,
        ]);
    }
}
