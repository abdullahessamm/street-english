<?php

namespace App\Http\Controllers\Api\Instructors\Courses\Zoom;

use App\Exceptions\Authorization\UnauthorizedException;
use App\Exceptions\Models\NotFoundException;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Api\InstructorDashboard\Courses\Zoom\Reports\CreateLevelReportRequest;
use App\Http\Requests\Api\InstructorDashboard\Courses\Zoom\Reports\CreateSessionReportRequest;
use App\Models\Coaches\Coach;
use App\Models\ZoomCourses\ZoomCourse;
use App\Models\ZoomCourses\ZoomCourseLevel;
use App\Models\ZoomCourses\ZoomCourseLevelReport;
use App\Models\ZoomCourses\ZoomCourseSession;
use App\Models\ZoomCourses\ZoomCourseSessionReport;
use App\Utils\Reports\LevelReportMaker;
use App\Utils\Reports\SessionReportMaker;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ReportsController extends ApiController
{
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

        if ($report->instructor_id !== auth('sanctum')->user()->id)
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

        if ($report->instructor_id !== auth('sanctum')->user()->id)
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

    public function reportCreationInit(): JsonResponse
    {
        request()->validate([
            'student_id' => 'required|exists:live_course_users,id'
        ]);

        $courses = ZoomCourse::with([
            'levels' => function (HasMany $q) {
                $q->select(['id', 'zoom_course_id', 'title']);
                $q->whereHas('groups', function (Builder $q) {
                    $q->where('instructor_id', auth('sanctum')->user()->id);
                    $q->whereHas('students', function (Builder $q) {
                        $q->where('id', request()->get('student_id'));
                    });
                });
                $q->orWhereHas('privates', function (Builder $q) {
                    $q->where('instructor_id', auth('sanctum')->user()->id);
                    $q->where('live_course_user_id', request()->get('student_id'));
                });
            },
            'levels.sessions:id,zoom_course_level_id,title'
        ])
            ->whereHas('levels.groups', function (Builder $q) {
                $q->where('instructor_id', auth('sanctum')->user()->id);
                $q->whereHas('students', function (Builder $q) {
                    $q->where('id', request()->get('student_id'));
                });
            })
            ->orWhereHas('levels.privates', function (Builder $q) {
                $q->where('instructor_id', auth('sanctum')->user()->id);
                $q->where('live_course_user_id', request()->get('student_id'));
            })
            ->get(['id', 'title']);

        return $this->apiSuccessResponse([
            'courses' => $courses
        ]);
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

        if (! $reqData->get('attended_at')) {
            return $this->apiSuccessResponse([
                "report" => ZoomCourseSessionReport::create($reqData->only(['session_id', 'instructor_id', 'live_course_user_id'])
                    ->toArray())->refresh()->load([
                        'session:id,zoom_course_level_id,title',
                        'session.level:id,zoom_course_id,title',
                        'session.level.course:id,title'
                    ])->only(['id', 'session_id', 'session'])
            ]);
        }

        if ($reqData->has('weakness_points'))
            $reqData->put('weakness_points', json_encode($reqData->get('weakness_points')));

        if ($reqData->has('strength_points'))
            $reqData->put('strength_points', json_encode($reqData->get('strength_points')));

        return $this->apiSuccessResponse([
            "report" => ZoomCourseSessionReport::create($reqData->toArray())->refresh()->load([
                'session:id,zoom_course_level_id,title',
                'session.level:id,zoom_course_id,title',
                'session.level.course:id,title'
            ])->only(['id', 'session_id', 'session'])
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

        if ($reqData->has('weakness_points'))
            $reqData->put('weakness_points', json_encode($reqData->get('weakness_points')));

        if ($reqData->has('strength_points'))
            $reqData->put('strength_points', json_encode($reqData->get('strength_points')));

        return $this->apiSuccessResponse([
            "report" => ZoomCourseLevelReport::create($reqData->toArray())
                ->refresh()->load([
                    'level:id,zoom_course_id,title',
                    'level.course:id,title'
                ])->only(['id', 'level_id', 'level']),
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
