<?php

namespace App\Http\Controllers;

use App\Mail\ActivationEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->user()) {
            $users = User::all();
            return response()->json($users);
        }
        return response()->json(['message' => 'Unauthorized'], 403);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => [
                'required',
                'string',
                'between:8,16',
                'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[#?!@$%^&*-]).{8,16}$/'
            ],

        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation errors',
                'errors' => $validator->errors(),
            ], 422);
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'activation_code' => str_pad(random_int(100000, 999999), 6, '0', STR_PAD_LEFT), // Generate a 6-digit activation code
        ]);

        // Send the activation email
        $activationLink = url("/api/activate/{$user->id}?code={$user->activation_code}");
        Mail::to($user->email)->send(new ActivationEmail($user,  $activationLink));

        return response()->json($user, 201);
    }

    public function loginUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), status: 422);
        }

        if (!Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = User::where('email', $request->email)->first();
            if (!$user) {
                return response()->json([
                    'message' => 'Incorrect email',
                    'status' => 401
                ], 401);
            }
            return response()->json([
                'message' => 'Password mismatch',
                'status' => 401
            ], 401);
        }


        $user = Auth::guard('user')->user();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Logged in successfully',
            'token' => $user->createToken('auth_token')->plainTextToken,
            'user' => $user
        ], 200);
    }

    public function logout(Request $request)
    {
        // Revoke the token that was used to authenticate the current request
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out successfully'], 200);
    }

    public function update(Request $request, $id)
    {
        $user = $request->user();
        if (!$user) {
            return response()->json(['message' => 'unauthenticated'], 401);
        }

        if ($user->id != $id) {
            return response()->json(['message' => 'You are not authorized to update this user'], 403);
        }
        $user = User::find($id);
        $user->update($request->all());
        return response()->json($user);
    }
}