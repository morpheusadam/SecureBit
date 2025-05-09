<?php

namespace Database\Seeders;

use App\Models\Blog\Post;
use App\Models\Blog\PostView;
use App\Models\User\User;
use Illuminate\Database\Seeder;

class BlogPostViewSeeder extends Seeder
{
    public function run()
    {
        $posts = Post::all();
        $users = User::limit(10)->get();
        
        foreach ($posts as $post) {
            // Create 50-100 views per post
            $viewCount = rand(50, 100);
            
            for ($i = 0; $i < $viewCount; $i++) {
                $isLoggedIn = rand(0, 1);
                
                PostView::create([
                    'post_id' => $post->id,
                    'ip_address' => $this->generateIpAddress(),
                    'user_agent' => $this->getRandomUserAgent(),
                    'user_id' => $isLoggedIn ? $users->random()->id : null,
                    'created_at' => now()->subDays(rand(0, 30))
                ]);
            }
            
            // Update the post's view count
            $post->update(['view_count' => $viewCount]);
        }
    }
    
    private function generateIpAddress()
    {
        return rand(1, 255) . '.' . rand(0, 255) . '.' . rand(0, 255) . '.' . rand(1, 255);
    }
    
    private function getRandomUserAgent()
    {
        $agents = [
            'Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
            'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7)',
            'Mozilla/5.0 (iPhone; CPU iPhone OS 15_0 like Mac OS X)',
            'Mozilla/5.0 (Linux; Android 11; SM-G991B)'
        ];
        
        return $agents[array_rand($agents)];
    }
}