<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\User;


class PostsController extends Controller
{
    public function index()
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized: ' . $e->getMessage(),
            ], 401);
        }

        $posts = Post::with(['user', 'comments.user', 'likes'])->get();
    
        $posts = $posts->map(function ($post) use ($user) {
            return [
                'id' => $post->id,
                'content' => $post->content,
                'image_url' => $post->image_url,
                'created_at' => $post->created_at,
                'updated_at' => $post->updated_at,
                'user' => [
                    'id' => $post->user->id,
                    'fullname' => $post->user->fullname,
                ],
                'comments' => $post->comments->map(function ($comment) {
                    return [
                        'id' => $comment->id,
                        'content' => $comment->content,
                        'created_at' => $comment->created_at,
                        'user' => [
                            'id' => $comment->user->id,
                            'fullname' => $comment->user->fullname,
                        ],
                    ];
                }),
                'likes_count' => $post->likes->count(),
                'is_liked' => $post->likes->where('user_id', $user->id)->count() > 0,
            ];
        });
    
        return response()->json([
            'success' => true,
            'data' => $posts,
        ]);
    }    


    public function store(Request $request)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized: ' . $e->getMessage(),
            ], 401);
        }
    
        $validator = Validator::make($request->all(), [
            'content' => 'required|string',
            'image_url' => 'nullable|url',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }
    
        $data = $validator->validated();
        $data['user_id'] = $user->id;
    
        $post = Post::create($data);
        $post->load('user');

        return response()->json([
            'success' => true,
            'message' => 'Post created successfully',
            'data' => [
                'id' => $post->id,
                'content' => $post->content,
                'image_url' => $post->image_url,
                'user_id' => $post->user_id,
                'created_at' => $post->created_at,
                'updated_at' => $post->updated_at,
                'user' => [
                    'id' => $post->user->id,
                    'fullname' => $post->user->fullname,
                ]
            ]
        ]);
        
    }


    public function show($id)
    {
        $post = Post::with('user')->findOrFail($id);
    
        return response()->json([
            'success' => true,
            'data' => [
                'id' => $post->id,
                'content' => $post->content,
                'image_url' => $post->image_url,
                'created_at' => $post->created_at,
                'updated_at' => $post->updated_at,
                'user' => [
                    'id' => $post->user->id,
                    'fullname' => $post->user->fullname,
                ]
            ]
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

        $post->load('user'); 

        return response()->json([
            'success' => true,
            'message' => 'Post created successfully',
            'data' => [
                'id' => $post->id,
                'content' => $post->content,
                'image_url' => $post->image_url,
                'user_id' => $post->user_id,
                'created_at' => $post->created_at,
                'updated_at' => $post->updated_at,
                'user' => [
                    'id' => $post->user->id,
                    'fullname' => $post->user->fullname,
                ]
            ]
        ]);
        
        
    }

    public function destroy($id)
    {
        $post = Post::find($id);
    
        if (!$post) {
            return response()->json([
                'success' => false,
                'message' => 'Post not found',
            ], 404);
        }
    
        $post->delete();
    
        return response()->json([
            'success' => true,
            'message' => 'Post deleted successfully',
        ]);
    }
    
}
