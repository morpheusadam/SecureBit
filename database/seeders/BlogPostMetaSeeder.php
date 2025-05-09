<?php

namespace Database\Seeders;

use App\Models\Blog\Post;
use App\Models\Blog\PostMeta;
use Illuminate\Database\Seeder;

class BlogPostMetaSeeder extends Seeder
{
    public function run()
    {
        // Only run if the table exists
        if (!\Schema::hasTable('post_meta')) {
            $this->command->warn('Skipping BlogPostMetaSeeder: post_meta table does not exist');
            return;
        }

        $posts = Post::all();
        
        $metaOptions = [
            'reading_time' => ['5 min', '7 min', '10 min', '12 min'],
            'schema_type' => ['Article', 'BlogPosting', 'NewsArticle'],
            'og_image' => ['og-image1.jpg', 'og-image2.jpg', 'og-image3.jpg'],
            'canonical_url' => [null, 'https://example.com/original-post']
        ];
        
        foreach ($posts as $post) {
            foreach ($metaOptions as $key => $values) {
                PostMeta::create([
                    'post_id' => $post->id,
                    'meta_key' => $key,
                    'meta_value' => $values[array_rand($values)]
                ]);
            }
        }
    }
}