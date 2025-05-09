<?php

namespace Database\Seeders;

use App\Models\Blog\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogPostSeeder extends Seeder
{
    public function run()
    {
        $posts = [
            [
                'title' => 'Getting Started with Laravel',
                'slug' => 'getting-started-with-laravel',
                'excerpt' => 'Learn the basics of Laravel framework',
                'content' => 'This is a comprehensive guide to getting started with Laravel...',
                'featured_image' => 'posts/laravel-intro.jpg',
                'author_id' => 1,
                'category_id' => 2,
                'status' => 'published',
                'published_at' => now(),
                'is_featured' => true,
                'meta_title' => 'Laravel Beginner Guide',
                'meta_description' => 'Complete guide for beginners to start with Laravel',
                'meta_keywords' => ['laravel', 'php', 'framework']
            ],
            [
                'title' => 'VueJS Components Deep Dive',
                'slug' => 'vuejs-components-deep-dive',
                'excerpt' => 'Master VueJS components architecture',
                'content' => 'In this article we will explore VueJS components in depth...',
                'featured_image' => 'posts/vuejs-components.jpg',
                'author_id' => 2,
                'category_id' => 3,
                'status' => 'published',
                'published_at' => now()->subDays(3),
                'is_featured' => false,
                'meta_title' => 'VueJS Components Guide',
                'meta_description' => 'Learn all about VueJS components',
                'meta_keywords' => ['vuejs', 'javascript', 'frontend']
            ],
            // Add more sample posts as needed
        ];

        foreach ($posts as $post) {
            Post::create($post);
        }
    }
}