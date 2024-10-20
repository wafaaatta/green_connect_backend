<?php

namespace App\Http\Controllers;

use App\Events\MessageCreated;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getConversationMessages(Request $request, $id)
    {

        $messages = Message::where('conversation_id', $id)
            ->with('reply_message')
            ->get();
        return response()->json($messages);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'conversation_id' => 'required|integer|exists:conversations,id',
            'message_type' => 'nullable|string|in:text,image|default:text',
            'content' => 'required_without:image|string|max:255',
            'image' => 'required_without:content|file|image'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = $request->user();

        $messageData = [
            'sender_id' => $user->id,
            'conversation_id' => $request->conversation_id,
            'message_type' => $request->message_type,
        ];

        if ($request['content']) {
            $messageData['content'] = $request['content'];
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images/messages'), $imageName);
            $messageData['image_url'] = 'images/messages/' . $imageName;
        }

        if ($request->reply_message_id) {
            $messageData['reply_message_id'] = $request->reply_message_id;
        }

        $message = Message::create($messageData);

        event(new MessageCreated($message));

        return response()->json($message);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Message $message)
    {
        $validator = Validator::make($request->all(), [
            'content' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $message->update($request->all());

        return response()->json($message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $message = Message::find($id);
        $message->delete();

        return response()->json('Message deleted successfully');
    }
}