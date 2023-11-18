<?php

namespace App\Http\Controllers\Api\Instructors\Courses\Zoom;

use App\Events\Zoom\Exams\ExamCorrected;
use App\Exceptions\Authorization\UnauthorizedException;
use App\Exceptions\Models\NotFoundException;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Api\InstructorDashboard\Courses\Zoom\Exams\CorrectStudentExamRequest;
use App\Models\ZoomCourses\ZoomCourseLevelStudentExam;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ExamsController extends ApiController
{

    /**
     * @param int $studentExamId
     * @return JsonResponse
     * @throws NotFoundException
     * @throws UnauthorizedException
     */
    public function initCorrection(int $studentExamId): JsonResponse
    {
        // try to find student's exam
        $studentExam = ZoomCourseLevelStudentExam::with([
            'student:id,name,image',
            'level:id,title',
            'level.exam:level_id,exam_id,start_at,duration',
            'exam:id,full_mark',
            'exam.sections.header',
            'exam.sections.questions',
            'answers:zoom_course_level_student_exam_id'
        ])->find($studentExamId);

        if (! $studentExam)
            throw new NotFoundException(ZoomCourseLevelStudentExam::class, $studentExamId);

        // throw forbidden if instructor can't correct the exam
        if (! auth('sanctum')->user()->can('correct', $studentExam))
            throw new UnauthorizedException();

        // check if exam ended when the current student exam is the level's exam
        if ($studentExam->level->exam->content->id === $studentExam->exam_id) {
            if (! $studentExam->level->exam->isEnded())
                throw new UnauthorizedException('Exam not ended.');
        }

        // remove exam info from level
        unset($studentExam->level->exam);

        // throw forbidden if exam already corrected
        if ($studentExam->corrected_at)
            throw new UnauthorizedException('Exam already corrected');

        return $this->apiSuccessResponse([
            "student_exam" => $studentExam
        ]);
    }

    public function correct(CorrectStudentExamRequest $request, int $studentExamId)
    {
        // try to find student exam
        $studentExam = ZoomCourseLevelStudentExam::with([
            'level',
            'answers:zoom_course_level_student_exam_id,exam_section_question_id'
        ])->find($studentExamId);

        if (! $studentExam)
            throw new NotFoundException(ZoomCourseLevelStudentExam::class, $studentExamId);

        // throw forbidden if instructor can't correct the exam
        if (! auth('sanctum')->user()->can('correct', $studentExam))
            throw new UnauthorizedException();

        // check if exam ended when the current student exam is the level's exam
        if ($studentExam->level->exam->content->id === $studentExam->exam_id) {
            if (! $studentExam->level->exam->isEnded())
                throw new UnauthorizedException('Exam not ended.');
        }

        // remove exam info from level
        unset($studentExam->level->exam);

        // throw forbidden if exam already corrected
        if ($studentExam->corrected_at)
            throw new UnauthorizedException('Exam already corrected');

        $correctedAnswers = collect($request->validated()['answers'])
            ->unique('question_id')
            ->whereIn('question_id', $studentExam->answers->pluck('exam_section_question_id')->toArray());

        if ($correctedAnswers->count() < $studentExam->answers->count())
            return response()->json([
                "success" => false,
                "message" => 'All questions must be corrected, corrected(' . $correctedAnswers->count() . ') of (' . $studentExam->answers->count() . ')'
            ], Response::HTTP_UNPROCESSABLE_ENTITY);

        $correctedAnswers->each(function ($correctedAnswer) use ($studentExam) {
            $correctedAnswer = (object) $correctedAnswer;
            $studentAnswer = $studentExam->answers->where('exam_section_question_id', $correctedAnswer->question_id)->first();
            $studentAnswer->instructor_correction = json_encode($correctedAnswer->correction);
            $studentAnswer->score = $correctedAnswer->score;
        });
        $studentExam->corrected_by = auth('sanctum')->user()->id;
        $studentExam->corrected_at = now();
        $studentExam->score = $correctedAnswers->sum('score');
        $studentExam->push();

        // fire event
        event(new ExamCorrected($studentExam));

        return $this->apiSuccessResponse();
    }
}
