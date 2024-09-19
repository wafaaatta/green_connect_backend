<?php

namespace App\Http\Controllers;

use App\Models\Manager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ManagerController extends Controller
{
    public function store(Request $request){
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:managers',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,supervisor'
        ]);
        if ($validation->fails()) {
            return response()->json($validation->errors(), 400);
        }
        $manager = Manager::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);
        return response()->json($manager);
    }
    /**
     * Handle manager login and return a token.
     */
    public function login(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Find the manager by email
        $manager = Manager::where('email', $request->email)->first();

        // Check if the manager exists and if the password is correct
        if (!$manager || !Hash::check($request->password, $manager->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        // Create a new token for the manager
        // $token = $manager->createToken()->plainTextToken;

        // Return the token along with manager details
        return response()->json([
            'message' => 'Logged in successfully',
            'manager' => $manager,
            // 'token' => $token
        ], 200);
    }

    /**
     * Handle manager logout and revoke token.
     */
    public function logout(Request $request)
    {
        // Revoke the token that was used to authenticate the current request
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out successfully'], 200);
    }
}
