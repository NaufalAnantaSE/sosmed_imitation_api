<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;

class CommentController extends Controller
{
    public function store(Request $request, $postId)
    {
        // Validasi request
        $request->validate([
            'content' => 'required|string|max:1000',
            'user_id' => 'required|exists:users,id',
        ]);

        // Buat komentar
        $comment = Comment::create([
            'post_id' => $postId,
            'user_id' => $request->input('user_id'),
            'content' => $request->input('content'),
        ]);

        return response()->json([
            'success' => true,
            'data' => $comment,
        ]);
    }

    public function index($postId)
{
    $comments = Comment::where('post_id', $postId)
        ->with('user') 
        ->latest()
        ->get();

    return response()->json([
        'success' => true,
        'data' => $comments,
    ]);
}

public function update(Request $request, $id)
{
    // Validasi input
    $request->validate([
        'content' => 'required|string|max:1000',
    ]);

    // Cari komentar
    $comment = Comment::findOrFail($id);

    // Update komentar
    $comment->update([
        'content' => $request->input('content'),
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Komentar berhasil diupdate.',
        'data' => $comment,
    ]);
}

public function destroy($id)
{
    // Cari komentar
    $comment = Comment::findOrFail($id);

    // Hapus komentar
    $comment->delete();

    return response()->json([
        'success' => true,
        'message' => 'Komentar berhasil dihapus.',
    ]);
}


}