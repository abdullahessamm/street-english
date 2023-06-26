<?php

namespace App\Http\Controllers\Api\Admins\Users\Students;

use App\Models\Students\Student;

class RecordedCourseStudentsController extends StudentController
{

    protected string $modelClassName = Student::class;

    public function __construct()
    {
        $this->abilities['index'] = auth('sanctum')->user()->can('index', Student::class);
        $this->abilities['store'] = auth('sanctum')->user()->can('create', Student::class);
        $this->abilities['show']  = auth('sanctum')->user()->can('index', Student::class);
        $this->abilities['update'] = auth('sanctum')->user()->can('update', Student::class);
        $this->abilities['destroy'] = auth('sanctum')->user()->can('delete', Student::class);
        $this->abilities['updateProfilePic'] = auth('sanctum')->user()->can('update', Student::class);
    }
}
