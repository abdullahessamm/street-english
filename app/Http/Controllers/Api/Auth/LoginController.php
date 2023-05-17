<?php

namespace App\Http\Controllers\Api\Auth;

use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LoginController
{
    public function login(Request $req)
    {
        // success credentials case
        if (auth()->attempt(['email' => $req->email, 'password' => $req->password], false)) {
            $admin = auth()->user();
            $token = $admin->createToken('admin-' . $admin->id . '-web-access', $admin->getAbilities());
            return response()->json([
                'success'   => true,
                'token'     => $token->plainTextToken,
                'user'      => $admin
            ], Response::HTTP_OK);
        }

        // wrong password case.
        if (Admin::where('email', $req->email)->first())
            return response()->json([
                'success'       => false,
                'email_err'     => false,
                'password_err'  => true,
            ], Response::HTTP_UNAUTHORIZED);
        // wrong email case.
        else
            return response()->json([
                'success'       => false,
                'email_err'     => true,
                'password_err'  => false,
            ], Response::HTTP_UNAUTHORIZED);
    }

    /**
     * send authenticated user info 
     *
     * @return void
     */
    public function user()
    {
        $admin = auth('sanctum')->user();
        return response()->json($admin);
    }

    public function logout()
    {
        auth('sanctum')->user()->currentAccessToken()->delete();
        return response()->json(['success' => true], Response::HTTP_OK);
    }
}
