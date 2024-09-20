<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ConversationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $conversations = Conversation::all();
        return response()->json($conversations);
    }

    public function getConversationsByAnnounceId($id)
    {
        $conversations = Conversation::where('announce_id', $id)->get();
        return response()->json($conversations);
    }

    public function getConversationsByParticipant($id)
    {
        $conversations = Conversation::where('participant_id', $id)->get();
        return response()->json($conversations);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'announce_id' => 'required|integer|exists:announces,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $conversation = Conversation::create([
            'name' => $request->name,
            'announce_id' => $request->announce_id,
        ]);

        return response()->json($conversation);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Conversation $conversation)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $conversation->name = $request->name;
        $conversation->save();

        return response()->json($conversation);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Conversation $conversation)
    {
        $conversation->delete();
        return response()->json($conversation);
    }
}
