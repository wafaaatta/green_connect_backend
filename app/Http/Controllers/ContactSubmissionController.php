<?php

namespace App\Http\Controllers;

use App\Models\ContactSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactSubmissionController extends Controller
{
    public function index()
    {
        return ContactSubmission::orderByDesc('created_at')->get();
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $contactSubmission = ContactSubmission::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ]);

        return response()->json($contactSubmission);
    }

    public function destroy($id)
    {
        $contactSubmission = ContactSubmission::find($id);
        $contactSubmission->delete();
        return response()->json($contactSubmission);
    }
}