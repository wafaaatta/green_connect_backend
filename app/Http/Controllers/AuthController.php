<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Validate the provided token.
     */
    public function validateToken(Request $request)
    {
        $user = Auth::guard('sanctum')->user();

        if ($user) {
            return response()->json([
                'message' => 'Token is valid',
                'user' => $user,
            ], 200);
        }

        return response()->json([
            'message' => 'Invalid token',
        ], 401);
    }
}