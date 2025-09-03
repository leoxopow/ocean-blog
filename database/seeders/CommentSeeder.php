<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;

class CommentSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $posts = Post::all();

        foreach ($posts as $post) {
            Comment::factory(rand(2,3))->make()->each(function ($comment) use ($users, $post) {
                $comment->user_id = $users->random()->id;
                $comment->post_id = $post->id;
                $comment->save();
            });
        }
    }
}
