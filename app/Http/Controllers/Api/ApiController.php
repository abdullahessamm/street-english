<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

abstract class ApiController extends Controller
{
    protected function apiSuccessResponse(array $data = [], int $status = 200, array $headers = [], int $options = 0)
    {
        $msg = ['success' => true];
        foreach ($data as $key => $val)
            $msg[$key] = $val;

        return response()->json($msg, $status, $headers, $options);
    }
}
