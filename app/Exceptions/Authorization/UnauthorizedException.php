<?php

namespace App\Exceptions\Authorization;

use Exception;
use Illuminate\Http\Response;

class UnauthorizedException extends Exception
{
    private ?string $msg;

    public function __construct(?string $msg = null)
    {
        $this->msg = $msg;
    }

    /**
     * Render the exception as an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        if ($request->wantsJson())
            return response()->json([
                'success' => false,
                'message' => $this->msg ?? 'Access denied'
            ], Response::HTTP_FORBIDDEN);
    }
}
