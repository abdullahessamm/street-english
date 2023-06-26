<?php

namespace App\Http\Controllers\Api\Admins\Users\Students;

use App\Models\IETLSCourses\IeltsUser;

class IELTSCourseStudentsController extends StudentController
{

    protected string $modelClassName = IeltsUser::class;

    public function __construct()
    {
        $this->abilities['index'] = auth('sanctum')->user()->can('index', IeltsUser::class);
        $this->abilities['store'] = auth('sanctum')->user()->can('create', IeltsUser::class);
        $this->abilities['show']  = auth('sanctum')->user()->can('index', IeltsUser::class);
        $this->abilities['update'] = auth('sanctum')->user()->can('update', IeltsUser::class);
        $this->abilities['destroy'] = auth('sanctum')->user()->can('delete', IeltsUser::class);
        $this->abilities['updateProfilePic'] = auth('sanctum')->user()->can('update', IeltsUser::class);
    }
}
