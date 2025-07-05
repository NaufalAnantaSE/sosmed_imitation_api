<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;


class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return response()->json([
            'success' => true,
            'data' => $posts,
        ]);
    }




    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            //bisa implementasi auth()
            'user_id' => 'required|exists:users,id',
            'content' => 'required|string',
            'image_url' => 'nullable|url',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $post = Post::create($validator->validated());

        return response()->json([
            'success' => true,
            'message' => 'Post created successfully',
            'data' => $post->load('user'),
        ]);
    }


    public function show($id)
    {
        $post = Post::find($id);
        return response()->json([
            'success' => true,
            'data' => $post,
        ]);
    }

    public function show_comments($id)
    {
        $post = Post::with(['user', 'comments.user'])->findOrFail($id);
        return view('posts.show', compact('post'));
    }


    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            //bisa implementasi auth()
            'content' => 'required|string',
            'image_url' => 'nullable|url',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $post = Post::find($id);
        $post->update($validator->validated());

        return response()->json([
            'success' => true,
            'message' => 'Post updated successfully',
            'data' => $post->load('user'),
        ]);
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();

        return response()->json([
            'success' => true,
            'message' => 'Post deleted successfully',
        ]);
    }
}
