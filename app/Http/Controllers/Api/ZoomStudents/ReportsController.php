<?php

namespace App\Http\Controllers\Api\ZoomStudents;

use App\Exceptions\Authorization\UnauthorizedException;
use App\Exceptions\Models\NotFoundException;
use App\Http\Controllers\Api\ApiController;
use App\Models\ZoomCourses\ZoomCourseLevelReport;
use App\Models\ZoomCourses\ZoomCourseSessionReport;
use App\Utils\Reports\LevelReportMaker;
use App\Utils\Reports\SessionReportMaker;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ReportsController extends ApiController
{
    /**
     * @return JsonResponse
     */
    public function sessionReports(): JsonResponse
    {
        return $this->apiSuccessResponse([
            'reports' => auth('sanctum')->user()->load([
                'sessionsReports:id,session_id,live_course_user_id',
                'sessionsReports.session:id,zoom_course_level_id,title',
                'sessionsReports.session.level:id,zoom_course_id,title',
                'sessionsReports.session.level.course:id,title'
            ])->sessionsReports
        ]);
    }

    /**
     * @return JsonResponse
     */
    public function levelsReports(): JsonResponse
    {
        return $this->apiSuccessResponse([
            'reports' => auth('sanctum')->user()->load([
                'levelsReports:id,level_id,live_course_user_id',
                'levelsReports.level:id,zoom_course_id,title',
                'levelsReports.level.course:id,title'
            ])->levelsReports
        ]);
    }

    /**
     * @param int $reportId
     * @return StreamedResponse
     * @throws NotFoundException
     * @throws UnauthorizedException
     */
    public function downloadSessionReport(int $reportId): StreamedResponse
    {
        $report = ZoomCourseSessionReport::find($reportId);
        if (! $report)
            throw new NotFoundException(ZoomCourseSessionReport::class, $reportId);

        if ($report->live_course_user_id !== auth('sanctum')->user()->id)
            throw new UnauthorizedException();

        return $this->downloadReport($report);
    }

    /**
     * @param int $reportId
     * @return StreamedResponse
     * @throws NotFoundException
     * @throws UnauthorizedException
     */
    public function downloadLevelReport(int $reportId): StreamedResponse
    {
        $report = ZoomCourseLevelReport::find($reportId);
        if (! $report)
            throw new NotFoundException(ZoomCourseLevelReport::class, $reportId);

        if ($report->live_course_user_id !== auth('sanctum')->user()->id)
            throw new UnauthorizedException();

        return $this->downloadReport($report);
    }

    /**
     * @param ZoomCourseSessionReport|ZoomCourseLevelReport $report
     * @return StreamedResponse
     */
    private function downloadReport(ZoomCourseSessionReport|ZoomCourseLevelReport $report): StreamedResponse
    {
        // make report image
        if ($report instanceof ZoomCourseSessionReport)
            $reportMaker = new SessionReportMaker($report);
        else
            $reportMaker = new LevelReportMaker($report);

        $reportImage = $reportMaker->make()->stream('jpeg', 100);

        return response()->stream(function () use ($reportImage) {
            echo $reportImage->getContents();
        }, 200, [
            "Content-Type" => "image/jpeg",
            "Content-Length" => $reportImage->getSize()
        ]);
    }
}
