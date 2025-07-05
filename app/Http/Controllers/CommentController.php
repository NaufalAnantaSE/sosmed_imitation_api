<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Tymon\JWTAuth\Facades\JWTAuth;

class CommentController extends Controller
{
    public function store(Request $request, $postId)
    {
        $user = JWTAuth::parseToken()->authenticate();

        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $comment = Comment::create([
            'post_id' => $postId,
            'user_id' => $user->id,
            'content' => $request->content,
        ]);

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $comment->id,
                'post_id' => $comment->post_id,
                'content' => $comment->content,
                'user' => [
                    'id' => $user->id,
                    'fullname' => $user->fullname,
                ],
                'created_at' => $comment->created_at,
            ]
        ]);
    }

    public function index($postId)
    {
        $comments = Comment::where('post_id', $postId)
            ->with('user:id,fullname') 
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'data' => $comments,
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = JWTAuth::parseToken()->authenticate();

        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $comment = Comment::findOrFail($id);

        if ($comment->user_id !== $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized: You can only edit your own comment.',
            ], 403);
        }

        $comment->update([
            'content' => $request->content,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Komentar berhasil diupdate.',
            'data' => $comment,
        ]);
    }

    public function destroy($id)
    {
        $user = JWTAuth::parseToken()->authenticate();

        $comment = Comment::findOrFail($id);

        if ($comment->user_id !== $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized: You can only delete your own comment.',
            ], 403);
        }

        $comment->delete();

        return response()->json([
            'success' => true,
            'message' => 'Komentar berhasil dihapus.',
        ]);
    }
}