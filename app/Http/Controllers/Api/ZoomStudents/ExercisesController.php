<?php

namespace App\Http\Controllers\Api\ZoomStudents;

use App\Exceptions\Authorization\UnauthorizedException;
use App\Exceptions\Models\NotFoundException;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Api\ZoomUserDashboard\Exercise\ExerciseAnswerRequest;
use App\Models\Exams\ExamSectionQuestion;
use App\Models\ZoomCourses\ZoomCourseSession;
use App\Models\ZoomCourses\ZoomCourseSessionStudentExercise;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class ExercisesController extends ApiController
{
    /**
     * @return JsonResponse
     */
    public function getSolvedExercises(): JsonResponse
    {
        return $this->apiSuccessResponse([
            'exercises' => auth('sanctum')->user()->solvedExercises()->with([
                'session:id,zoom_course_level_id,title',
                'session.level:id,zoom_course_id,title',
                'session.level.course:id,title',
            ])->get([
                'id',
                'session_id',
                'exam_id',
                'student_id',
                'joined_at',
                'finished_at',
                'score',
                'corrected_at'
            ])
        ]);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function getSolvedExercise(int $id): JsonResponse
    {
        return $this->apiSuccessResponse([
            'exercise' => auth('sanctum')->user()->solvedExercises()->with([
                'answers',
                'session:id,zoom_course_level_id,title',
                'session.level:id,zoom_course_id,title',
                'session.level.course:id,title',
                'exam:id,full_mark',
                'exam.sections:id,title,score',
                'exam.sections.header',
                'exam.sections.questions'
            ])->find($id, ['id', 'session_id', 'exam_id', 'student_id', 'joined_at', 'finished_at', 'score', 'corrected_at'])
        ]);
    }

    /**
     * @param ExerciseAnswerRequest $request
     * @return JsonResponse
     * @throws NotFoundException
     * @throws UnauthorizedException
     */
    public function answerExercise(ExerciseAnswerRequest $request): JsonResponse
    {
        $reqData = collect($request->validated());
        $session = ZoomCourseSession::find($reqData->get('session_id'));
        // check if session has exercise
        if (! $session->exercises()->where('id', $reqData->get('exam_id'))->wherePivot('opened', true)->exists())
            throw new NotFoundException('session\exercise', $reqData->get('exam_id'));

        // check student rights
        if (! $this->studentHasAccessToSession($session))
            throw new UnauthorizedException();

        // check if student answered the exercise
        if ($this->studentAnsweredExercise($reqData->get('exam_id'), $reqData->get('session_id')))
            throw new UnauthorizedException('Exercise already answered.');

        // sanitize and validate answers
        $answers = $this->sanitizeAndValidateAnswers($reqData->get('exam_id'), $reqData->get('answers'))
            ->map(function ($ans) {
                return [
                    'exam_section_question_id' => $ans['question_id'],
                    'student_answer'           => json_encode($ans['answer'])
                ];
            })->toArray();

        // save exercise answer
        $studentExercise = auth('sanctum')->user()->solvedExercises()->create($reqData->except('answers')->toArray());
        $studentExercise->answers()->createMany($answers);

        return $this->apiSuccessResponse();
    }

    /**
     * @param ZoomCourseSession $session
     * @return bool
     */
    private function studentHasAccessToSession(ZoomCourseSession $session): bool
    {
        return $session->level()->whereHas('groups.students', function (Builder $q) {
            $q->where('id', auth('sanctum')->user()->id);
        })->exists() ||
        $session->level()->whereHas('privates', function (HasMany $q) {
            $q->where('live_course_user_id', auth('sanctum')->user()->id);
        })->exists();
    }

    /**
     * @param int $examId
     * @param int $sessionId
     * @return bool
     */
    private function studentAnsweredExercise(int $examId, int $sessionId): bool
    {
        return ZoomCourseSessionStudentExercise::where('exam_id', $examId)->where('session_id', $sessionId)->exists();
    }

    private function sanitizeAndValidateAnswers(int $examId, array $answers): Collection
    {
        $examQuestions = ExamSectionQuestion::whereHas('section.exams', function (Builder $q) use ($examId) {
            $q->where('id', $examId);
        })->get();

        // sanitize
        $answers = collect($answers)->whereIn('question_id', $examQuestions->pluck('id')->toArray());

        // validation
        $answers->each(function ($answer, $i) use ($examQuestions) {
            $qType = $examQuestions->where('id', $answer['question_id'])->first()->type;
            $answerPoints = collect($answer['answer']);
            if ($qType === ExamSectionQuestion::TYPE_OPEN_ENDED || $qType === ExamSectionQuestion::TYPE_COMPLETE) {
                if ($answerPoints->count() !== $answerPoints->filter(fn($e) => is_string($e))->count())
                    throw new UnprocessableEntityHttpException("answers.$i.answer contains element with invalid format");
                if ($answerPoints->count() !== $answerPoints->filter(fn($e) => strlen($e) <= 255)->count())
                    throw new UnprocessableEntityHttpException("answers.$i.answer contains element with invalid format");
            } else if ($answerPoints->count() !== $answerPoints->filter(fn($e) => is_integer($e))->count()) {
                throw new UnprocessableEntityHttpException("answers.$i.answer contains element with invalid format");
            }
        });

        return $answers;
    }
}
