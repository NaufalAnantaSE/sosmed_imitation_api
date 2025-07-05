<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\Message;

class MessagesController extends Controller
{
    public function store(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();

        $validator = Validator::make($request->all(), [
            'receiver_id' => 'required|exists:users,id',
            'message_content' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $message = Message::create([
            'sender_id' => $user->id,
            'receiver_id' => $request->receiver_id,
            'message_content' => $request->message_content
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Message created successfully',
            'data' => [
                'id' => $message->id,
                'message_content' => $message->message_content,
                'receiver_id' => $message->receiver_id,
                'sender_id' => $message->sender_id,
                'created_at' => $message->created_at,
            ],
        ]);
    }

    public function show($id)
    {
        $user = JWTAuth::parseToken()->authenticate();

        $message = Message::findOrFail($id);

        if ($message->sender_id !== $user->id && $message->receiver_id !== $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized access to this message',
            ], 403);
        }

        return response()->json([
            'success' => true,
            'data' => $message,
        ]);
    }

    public function destroy($id)
    {
        $user = JWTAuth::parseToken()->authenticate();

        $message = Message::findOrFail($id);

        if ($message->sender_id !== $user->id && $message->receiver_id !== $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized to delete this message',
            ], 403);
        }

        $message->delete();

        return response()->json([
            'success' => true,
            'message' => 'Message deleted successfully',
        ]);
    }

    public function getMessages()
    {
        $user = JWTAuth::parseToken()->authenticate();

        $messages = Message::where('receiver_id', $user->id)
            ->orWhere('sender_id', $user->id)
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil mengambil pesan',
            'data' => $messages
        ]);
    }
}
