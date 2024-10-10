<?php

namespace App\Http\Controllers;

use App\Mail\ActivationEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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

    public function activate(User $user, Request $request)
    {
        // Check if the activation code matches
        if ($request->input('code') !== $user->activation_code) {
            return response()->json(['error' => 'Invalid activation code.'], 400);
        }

        // Activate the user's account
        $user->email_verified_at = now();
        $user->activation_code = null; // Clear the activation code after verification
        $user->save();

        return response()->json(['message' => 'Your account has been successfully activated.']);
    }

    public function resendActivationEmail(Request $request)
    {
        $user = User::where('email', $request->input('email'))->first();

        if (!$user) {
            return response()->json(['error' => 'User not found.'], 404);
        }

        if ($user->hasVerifiedEmail()) {
            return response()->json(['error' => 'This account is already activated.'], 400);
        }

        // Resend activation email
        $activationLink = url("/activate/{$user->id}?code={$user->activation_code}");
        Mail::to($user->email)->send(new ActivationEmail($user, $user->activation_code, $activationLink));

        return response()->json(['message' => 'Activation email resent. Please check your inbox.']);
    }

}