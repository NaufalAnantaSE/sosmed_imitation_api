<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;
use App\Models\Like;
use App\Models\Comment;
use App\Models\Message;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create 10 users
        $users = User::factory()->count(10)->create();

        // Create 20 posts, each linked to a random user
        $posts = Post::factory()
            ->count(20)
            ->make()
            ->each(function ($post) use ($users) {
                $post->user_id = $users->random()->id;
                $post->save();
            });

        // Create 50 likes, linking random users to random posts
        Like::factory()
            ->count(50)
            ->make()
            ->each(function ($like) use ($users, $posts) {
                $like->user_id = $users->random()->id;
                $like->post_id = $posts->random()->id;
                $like->save();
            });

        // Create 30 comments, linking random users to random posts
        Comment::factory()
            ->count(30)
            ->make()
            ->each(function ($comment) use ($users, $posts) {
                $comment->user_id = $users->random()->id;
                $comment->post_id = $posts->random()->id;
                $comment->save();
            });

        // Create 40 messages, linking random sender and receiver users
        Message::factory()
            ->count(40)
            ->make()
            ->each(function ($message) use ($users) {
                $message->sender_id = $users->random()->id;
                $message->receiver_id = $users->random()->id;
                $message->save();
            });
    }
}