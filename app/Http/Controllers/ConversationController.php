<?php

namespace App\Http\Controllers;

use App\Events\ConversationCreated;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function getConversationsByUserId(Request $request)
    {
        $user = $request->user();
        $id = $user->id;
        $conversations = Conversation::where('receiver_id', $id)->orWhere('creator_id', $id)->get();
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
            'receiver_id' => 'required|integer|max:255',
            'announce_id' => 'required|integer|exists:announces,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = $request->user();

        $conversation = Conversation::where('creator_id', $user->id)
            ->where('receiver_id', $request->receiver_id)
            ->where('announce_id', $request->announce_id)
            ->get();

        if ($conversation -> count() > 0) {
            return response()->json([
                'message' => 'Conversation already exists',
            ], 422);
        }

        $new_conversation = Conversation::create([
            'creator_id' => $user->id,
            'receiver_id' => $request->receiver_id,
            'announce_id' => $request->announce_id,
        ]);

        event(new ConversationCreated($new_conversation));

        return response()->json($new_conversation);
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
    public function destroy(Request $request, $id)
    {
        Message::where('conversation_id', $id)->delete();

        $conversation = Conversation::find($id);
        $conversation->delete();

        return response()->json('Conversation deleted successfully');
    }
}