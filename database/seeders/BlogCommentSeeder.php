<?php

namespace Database\Seeders;

use App\Models\Blog\Comment;
use App\Models\Blog\Post;
use App\Models\User\User;
use Illuminate\Database\Seeder;

class BlogCommentSeeder extends Seeder
{
    public function run()
    {
        $posts = Post::all();
        $users = User::limit(5)->get();
        
        foreach ($posts as $post) {
            // Create 3-5 comments per post
            for ($i = 0; $i < rand(3, 5); $i++) {
                $isGuest = rand(0, 1);
                
                $commentData = [
                    'content' => $this->generateCommentContent(),
                    'post_id' => $post->id,
                    'status' => rand(0, 1) ? 'approved' : 'pending',
                    'author_ip' => '192.168.1.' . rand(1, 255),
                    'author_user_agent' => $this->getRandomUserAgent(),
                ];
                
                if ($isGuest) {
                    $commentData['author_name'] = 'Guest User ' . rand(100, 999);
                    $commentData['author_email'] = 'guest' . rand(100, 999) . '@example.com';
                } else {
                    $user = $users->random();
                    $commentData['user_id'] = $user->id;
                }
                
                $comment = Comment::create($commentData);
                
                // 30% chance to have a reply
                if (rand(1, 10) <= 3) {
                    Comment::create([
                        'content' => $this->generateReplyContent(),
                        'post_id' => $post->id,
                        'parent_id' => $comment->id,
                        'user_id' => $users->random()->id,
                        'status' => 'approved',
                        'author_ip' => '192.168.1.' . rand(1, 255),
                        'author_user_agent' => $this->getRandomUserAgent(),
                    ]);
                }
            }
        }
    }
    
    private function generateCommentContent()
    {
        $phrases = [
            'Great article! Thanks for sharing.',
            'Very helpful, especially for beginners.',
            'I found a small typo in section 3.',
            'Could you elaborate more on this topic?',
            'This solved my problem, thank you!',
            'I have a different approach to this.',
            'Well explained and easy to follow.',
            'Looking forward to more content like this.'
        ];
        
        return $phrases[array_rand($phrases)];
    }
    
    private function generateReplyContent()
    {
        $phrases = [
            'Thanks for your feedback!',
            'I appreciate your comment.',
            'I\'ll look into that issue.',
            'Good point, I\'ll consider that.',
            'Glad it helped you!',
            'Interesting perspective.',
            'I\'ll cover that in a future post.'
        ];
        
        return $phrases[array_rand($phrases)];
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