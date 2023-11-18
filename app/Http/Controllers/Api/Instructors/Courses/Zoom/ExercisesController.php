<?php

namespace App\Http\Controllers\Api\Instructors\Courses\Zoom;

use App\Events\Zoom\Exercises\ExerciseCorrected;
use App\Exceptions\Authorization\UnauthorizedException;
use App\Exceptions\Models\NotFoundException;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Api\InstructorDashboard\Courses\Zoom\Exercises\CorrectStudentExerciseRequest;
use App\Models\ZoomCourses\ZoomCourseSessionStudentExercise;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ExercisesController extends ApiController
{

    /**
     * @param integer $studentExerciseId
     * @return JsonResponse
     * @throws NotFoundException
     * @throws UnauthorizedException
     */
    public function initCorrection(int $studentExerciseId): JsonResponse
    {
        $studentExercise = ZoomCourseSessionStudentExercise::with([
            'student:id,name,image',
            'exam:id,full_mark',
            'exam.sections:id,title,score',
            'exam.sections.header',
            'exam.sections.questions',
            'answers:student_exercise_id,exam_section_question_id,student_answer'
        ])
        ->where('finished_at', '!=', null)
        ->find($studentExerciseId, [
            'id', 'session_id', 'exam_id', 'student_id'
        ]);

        if (! $studentExercise)
            throw new NotFoundException(ZoomCourseSessionStudentExercise::class, $studentExerciseId);

        if (! auth('sanctum')->user()->can('correct', $studentExercise))
            throw new UnauthorizedException();

        return $this->apiSuccessResponse([
            'exercise' => $studentExercise
        ]);
    }

    /**
     * @param CorrectStudentExerciseRequest $request
     * @param integer $studentExerciseId
     * @return JsonResponse
     * @throws NotFoundException
     * @throws UnauthorizedException
     */
     public function correct(CorrectStudentExerciseRequest $request, int $studentExerciseId): JsonResponse
     {
        $studentExercise = ZoomCourseSessionStudentExercise::with(['answers:student_exercise_id,exam_section_question_id'])
            ->where('finished_at', '!=', null)
            ->find($studentExerciseId);

        // throw not found exception.
        if (! $studentExercise)
            throw new NotFoundException(ZoomCourseSessionStudentExercise::class, $studentExerciseId);

        // throw unauthorized exception if user can't correct exam.
        if (! auth('sanctum')->user()->can('correct', $studentExercise))
            throw new UnauthorizedException();

        // throw unauthorized exeption if exercise has been already corrected.
        if ($studentExercise->corrected_at)
            throw new UnauthorizedException("Exercise already corrected");

        // filter corrected answers
        $correctedAnswers = collect($request->validated()['answers'])
            ->filter(function ($answer) use ($studentExercise) {
                return $studentExercise->answers
                    ->where('exam_section_question_id', $answer['question_id'])->count() > 0;
            })->unique('question_id');

        // return 422 if
        if ($studentExercise->answers->count() > $correctedAnswers->count())
            return response()->json([
                "success" => false,
                "message" => 'All questions must be corrected, corrected(' . $correctedAnswers->count() . ') of (' . $studentExercise->answers->count() . ')'
            ], Response::HTTP_UNPROCESSABLE_ENTITY);

        // save correction to DB
        $correctedAnswers->each(function ($correctedAnswer) use ($studentExercise) {
            $correctedAnswer = (object) $correctedAnswer;
            $studentAnswer = $studentExercise->answers->where('exam_section_question_id', $correctedAnswer->question_id)->first();
            $studentAnswer->instructor_correction = json_encode($correctedAnswer->correction);
            $studentAnswer->score = $correctedAnswer->score;
        });
        $studentExercise->corrected_by = auth('sanctum')->user()->id;
        $studentExercise->corrected_at = now();
        $studentExercise->score = $correctedAnswers->sum('score');
        $studentExercise->push();

        // fire event
        event(new ExerciseCorrected($studentExercise));

        return $this->apiSuccessResponse();
     }
}
