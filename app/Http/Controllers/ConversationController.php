<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ConversationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $conversations = Conversation::with('messages') -> all();
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

     /*
        unique conversation data:
        receiver + announce_id + creator
        > creator cannot send twice for same announce id
    */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'creator_id' => 'required|string|max:255',
            'receiver_id' => 'required|string|max:255',
            'announce_id' => 'required|integer|exists:announces,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $conversation = Conversation::where('creator', $request->creator_id)
            ->where('receiver', $request->receiver_id)
            ->where('announce_id', $request->announce_id)
            ->first();
        
        if ($conversation) {
            return response()->json([
                'message' => 'Conversation already exists',
            ], 422);
        } 

        $conversation = Conversation::create([
            'name' => $request->name,
            'creator' => $request->creator,
            'announce_id' => $request->announce_id,
        ]);

        return response()->json($conversation);
    }

    function createMessage(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'content' => 'required|string|max:255',
            'sender_id' => 'required|integer|exists:users,id',
            'receiver_id' => 'required|integer|exists:users,id',
            'conversation_id' => 'required|integer|exists:conversations,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $message = Message::create($request->all());
        return response()->json($message);
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