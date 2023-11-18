<?php

namespace App\Http\Requests\Api\InstructorDashboard\Courses\Zoom\Exercises;

use App\Http\Requests\Api\InstructorDashboard\Courses\Zoom\AbstractExamRequest;

class CorrectStudentExerciseRequest extends AbstractExamRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

}
