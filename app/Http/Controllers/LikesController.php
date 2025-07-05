<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;

class LikesController extends Controller
{
    public function count($postId)
    {
        $count = Like::where('post_id', $postId)->count();

        return response()->json([
            'success' => true,
            'likes_count' => $count,
        ]);
    }

    public function like(Request $request, $postId)
    {
        $userId = $request->query('user_id');

        if (!$userId) {
            return response()->json([
                'success' => false,
                'message' => 'user_id is required',
            ], 422);
        }

        $exists = Like::where('post_id', $postId)->where('user_id', $userId)->exists();

        if ($exists) {
            return response()->json([
                'success' => false,
                'message' => 'User has already liked this post',
            ], 409);
        }

        $like = Like::create([
            'post_id' => $postId,
            'user_id' => $userId,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Post liked',
            'data' => $like,
        ]);
    }

    public function unlike(Request $request, $postId)
    {
        $userId = $request->query('user_id');

        if (!$userId) {
            return response()->json([
                'success' => false,
                'message' => 'user_id is required in query',
            ], 422);
        }

        $deleted = Like::where('post_id', $postId)->where('user_id', $userId)->delete();

        if ($deleted) {
            return response()->json([
                'success' => true,
                'message' => 'Like removed',
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Like not found',
        ], 404);
    }
}
