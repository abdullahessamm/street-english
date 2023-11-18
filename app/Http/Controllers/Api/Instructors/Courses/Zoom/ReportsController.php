<?php

namespace App\Http\Controllers\Api\Instructors\Courses\Zoom;

use App\Exceptions\Authorization\UnauthorizedException;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Api\InstructorDashboard\Courses\Zoom\Reports\CreateLevelReportRequest;
use App\Http\Requests\Api\InstructorDashboard\Courses\Zoom\Reports\CreateSessionReportRequest;
use App\Models\Coaches\Coach;
use App\Models\ZoomCourses\ZoomCourseLevel;
use App\Models\ZoomCourses\ZoomCourseLevelReport;
use App\Models\ZoomCourses\ZoomCourseSession;
use App\Models\ZoomCourses\ZoomCourseSessionReport;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class ReportsController extends ApiController
{

    /**
     * @param Coach $instructor
     * @param integer $levelId
     * @param integer $studentId
     * @return boolean
     */
    private function instructorCanReport(Coach $instructor, int $levelId, int $studentId): bool
    {
        $groupsContainsStudent = $instructor->groups()
            ->where('zoom_course_level_id', $levelId)
            ->whereHas('students', function ($q) use ($studentId) {
                $q->where('id', $studentId);
            })
            ->get(['id', 'zoom_course_level_id']);

        $privatesContainsStudent = $instructor->privates()
            ->where('zoom_course_level_id', $levelId)
            ->where('live_course_user_id', $studentId)
            ->get(['id']);

        return $groupsContainsStudent->count() > 0 || $privatesContainsStudent->count() > 0;
    }

    /**
     * @param CreateSessionReportRequest $request
     * @return JsonResponse
     * @throws UnauthorizedException
     */
    public function createSessionReport(CreateSessionReportRequest $request): JsonResponse
    {
        $reqData = collect($request->validated());

        // check if report already exists
        if (
            ZoomCourseSessionReport::where('session_id', $reqData->get('session_id'))
                ->where('live_course_user_id', $reqData->get('live_course_user_id'))
                ->first()
        )
            throw new UnauthorizedException("Report already exists");


        $session = ZoomCourseSession::find($reqData->get('session_id'));

        $instructor = auth('sanctum')->user();

        // check if student in instructor's groups or privates that in session's level
        if (! $this->instructorCanReport($instructor, $session->zoom_course_level_id, $reqData->get('live_course_user_id')))
            throw new UnauthorizedException();

        $reqData->put('instructor_id', $instructor->id);

        if ($reqData->has('weakness_points'))
            $reqData->put('weakness_points', json_encode($reqData->get('weakness_points')));

        if ($reqData->has('strength_points'))
            $reqData->put('strength_points', json_encode($reqData->get('strength_points')));

        return $this->apiSuccessResponse([
            "report" => ZoomCourseSessionReport::create($reqData->toArray())->refresh()
        ]);
    }

    /**
     * @param CreateLevelReportRequest $request
     * @return JsonResponse
     * @throws UnauthorizedException
     */
    public function createLevelReport(CreateLevelReportRequest $request): JsonResponse
    {
        $reqData = collect($request->validated());

        // check if report already exists
        if (
            ZoomCourseLevelReport::where('level_id', $reqData->get('level_id'))
                ->where('live_course_user_id', $reqData->get('live_course_user_id'))
                ->first()
        )
            throw new UnauthorizedException("Report already exists");

        $instructor = auth('sanctum')->user();

        // check if student in instructor's groups or privates
        if (! $this->instructorCanReport($instructor, $reqData->get('level_id'), $reqData->get('live_course_user_id')))
            throw new UnauthorizedException();

        $levelSessions = ZoomCourseLevel::with(['sessions:id,zoom_course_level_id'])->find($reqData->get('level_id'))->sessions;
        $sessionsReports = ZoomCourseSessionReport::where('live_course_user_id', $reqData->get('live_course_user_id'))
            ->whereIn('session_id', $levelSessions->pluck('id')->toArray())
            ->get();

        // calc data
        $attendance = $this->calcAttendance($sessionsReports, $levelSessions->count());
        $participation = $this->calcLevelParticipation($sessionsReports, $levelSessions->count());

        $reqData->put('attendance', $attendance);
        $reqData->put('participation', $participation);
        $reqData->put('instructor_id', $instructor->id);

        return $this->apiSuccessResponse([
            "report" => ZoomCourseLevelReport::create($reqData->toArray())->refresh(),
        ]);
    }

    /**
     * @param Collection $sessionsReports
     * @param integer $levelSessionsCount
     * @return float
     */
    private function calcAttendance(Collection $sessionsReports, int $levelSessionsCount): float
    {
        $attendedCount = $sessionsReports->where('attended_at', '!=', null)->count();
        return round(($attendedCount/$levelSessionsCount)*100, 2);
    }

    /**
     * @param Collection $sessionsReports
     * @param integer $levelSessionsCount
     * @return float
     */
    private function calcLevelParticipation(Collection $sessionsReports, int $levelSessionsCount): float
    {
        $sumOfParticipations = $sessionsReports->where('participation', '!=', null)->pluck('participation')->sum();
        return round(($sumOfParticipations/($levelSessionsCount * 100)) * 100, 2);
    }
}
