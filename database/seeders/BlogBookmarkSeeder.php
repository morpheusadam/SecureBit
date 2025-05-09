<?php

namespace Database\Seeders;

use App\Models\Blog\Post;
use App\Models\Blog\Bookmark;
use App\Models\User\User;
use Illuminate\Database\Seeder;

class BlogBookmarkSeeder extends Seeder
{
    public function run()
    {
        $users = User::limit(10)->get();
        $posts = Post::all();
        $postCount = $posts->count();

        // Skip if there are no posts
        if ($postCount === 0) {
            $this->command->warn('No posts available. Skipping bookmark seeding.');
            return;
        }

        foreach ($users as $user) {
            // Determine how many posts to bookmark (1-3 or max available if less)
            $bookmarkCount = min(3, $postCount);
            
            // Get random posts to bookmark
            $postsToBookmark = $posts->random($bookmarkCount);
            
            foreach ($postsToBookmark as $post) {
                Bookmark::create([
                    'user_id' => $user->id,
                    'post_id' => $post->id,
                    'created_at' => now()->subDays(rand(0, 30))
                ]);
            }
        }
    }
}