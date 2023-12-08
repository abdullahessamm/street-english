<?php

namespace App\Http\Controllers\Api\ZoomStudents;

use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\JsonResponse;

class ExamsController extends ApiController
{
    /**
     * @return JsonResponse
     */
    public function getSolvedExams(): JsonResponse
    {
        return $this->apiSuccessResponse([
            'exercises' => auth('sanctum')->user()->solvedExams()->with([
                'level:id,zoom_course_id,title',
                'level.course:id,title',
            ])->get([
                'id',
                'level_id',
                'student_id',
                'joined_at',
                'finished_at',
                'score',
                'corrected_at'
            ])
        ]);
    }

//    /**
//     * @param int $id
//     * @return JsonResponse
//     */
//    public function getSolvedExam(int $id): JsonResponse
//    {
//        return $this->apiSuccessResponse([
//            'exercise' => auth('sanctum')->user()->solvedExams()->with([
//                'answers',
//                'level:id,zoom_course_id,title',
//                'level.course:id,title',
//                'exam:id,full_mark',
//                'exam.sections:id,title,score',
//                'exam.sections.header',
//                'exam.sections.questions'
//            ])->find($id, ['id', 'level_id', 'exam_id', 'student_id', 'joined_at', 'finished_at', 'score', 'corrected_at'])
//        ]);
//    }
}
