<?php

namespace App\Exceptions\AdminDashboard\Users\Students\Zoom\Courses;

use Exception;
use Illuminate\Http\Response;

class StudentDoesnotEnrolledToCourseException extends Exception
{
    public function render()
    {
        return response()->json([
            'success' => false,
            'message' => 'Student doesn\'t enrolled to requested course.'
        ], Response::HTTP_NOT_ACCEPTABLE);
    }
}
