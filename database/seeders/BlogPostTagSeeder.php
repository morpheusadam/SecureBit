<?php

namespace Database\Seeders;

use App\Models\Blog\Post;
use Illuminate\Database\Seeder;

class BlogPostTagSeeder extends Seeder
{
    public function run()
    {
        $posts = Post::all();
        
        foreach ($posts as $post) {
            // Attach random tags to each post (2-4 tags per post)
            $tags = range(1, 8);
            shuffle($tags);
            $post->tags()->attach(array_slice($tags, 0, rand(2, 4)));
        }
    }
}