<?php

namespace App\Http\Controllers\Api\Auth;

use App\Admin;
use App\Models\Coaches\Coach;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LoginController
{
//    public function login(Request $req)
//    {
//        // api login code...
//    }

    /**
     * send authenticated user info
     *
     * @return JsonResponse
     */
    public function user(): JsonResponse
    {
        $user = auth('sanctum')->user();
        if ($user instanceof Coach)
            $user->load('info');
        return response()->json($user);
    }

//    public function logout()
//    {
//        // api logout code
//    }
}
