<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Message;

class MessagesController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            //bisa implementasi auth()
            'sender_id' => 'required|exists:users,id',
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
            'sender_id' => $request->sender_id,
            'receiver_id' => $request->receiver_id,
            'message_content' => $request->message_content
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Message created successfully',
            'data' => $message,
        ]);
    }

    public function show($id)
    {
        $message = Message::find($id);
        return response()->json([
            'success' => true,
            'data' => $message,
        ]);
    }

    public function destroy($id)
    {
        $message = Message::find($id);
        $message->delete();

        return response()->json([
            'success' => true,
            'message' => 'Message deleted successfully',
        ]);
    }

    public function getMessages(int $user_id)
    {
        $messages = Message::where('receiver_id', $user_id)->get();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil mengambil pesan-pesan berdasarkan user',
            'data' => $messages
        ]);
    }
}
