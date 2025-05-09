<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Blog\Category;
use App\Models\Blog\Post;
use App\Models\Blog\Tag;
use App\Models\User\User;

class BlogSeeder extends Seeder
{
    public function run()
    {
        // ایجاد دسته‌بندی‌های نمونه
        $categories = [
            ['name' => 'تکنولوژی', 'slug' => 'technology'],
            ['name' => 'برنامه‌نویسی', 'slug' => 'programming', 'parent_id' => 1],
            ['name' => 'طراحی وب', 'slug' => 'web-design', 'parent_id' => 1],
            ['name' => 'سبک زندگی', 'slug' => 'lifestyle'],
            ['name' => 'سفر', 'slug' => 'travel', 'parent_id' => 4],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // ایجاد تگ‌های نمونه
        $tags = [
            ['name' => 'لاراول', 'slug' => 'laravel'],
            ['name' => 'پیاچپی', 'slug' => 'php'],
            ['name' => 'جاوااسکریپت', 'slug' => 'javascript'],
            ['name' => 'ویو جی‌اس', 'slug' => 'vuejs'],
            ['name' => 'ریکت', 'slug' => 'react'],
        ];

        foreach ($tags as $tag) {
            Tag::create($tag);
        }

        // ایجاد مطالب نمونه
        $admin = User::where('email', 'admin@example.com')->first();
        $editor = User::where('email', 'editor@example.com')->first();
        $author = User::where('email', 'author@example.com')->first();

        $posts = [
            [
                'title' => 'آموزش لاراول 10',
                'slug' => 'laravel-10-tutorial',
                'excerpt' => 'آموزش جامع لاراول 10 برای توسعه‌دهندگان وب',
                'content' => 'محتوای کامل آموزش لاراول 10...',
                'author_id' => $admin->id,
                'category_id' => 2,
                'status' => 'published',
                'published_at' => now(),
                'is_featured' => true,
                'meta_title' => 'آموزش لاراول 10 - راهنمای جامع',
                'meta_description' => 'آموزش کامل لاراول 10 برای توسعه‌دهندگان وب',
                'meta_keywords' => ['لاراول', 'آموزش لاراول', 'php', 'فریمورک لاراول'],
            ],
            [
                'title' => 'یادگیری ویو جی‌اس 3',
                'slug' => 'vuejs-3-learning',
                'excerpt' => 'آموزش ویو جی‌اس 3 برای توسعه فرانت‌اند',
                'content' => 'محتوای کامل آموزش ویو جی‌اس 3...',
                'author_id' => $editor->id,
                'category_id' => 2,
                'status' => 'published',
                'published_at' => now()->subDays(3),
                'is_featured' => false,
            ],
            [
                'title' => 'بهترین مکان‌های گردشگری ایران',
                'slug' => 'best-tourist-places-iran',
                'excerpt' => 'معرفی بهترین مکان‌های گردشگری ایران',
                'content' => 'محتوای کامل معرفی مکان‌های گردشگری...',
                'author_id' => $author->id,
                'category_id' => 5,
                'status' => 'published',
                'published_at' => now()->subWeek(),
                'is_featured' => true,
            ],
        ];

        foreach ($posts as $postData) {
            $post = Post::create($postData);
            
            // اختصاص تگ‌ها به مطالب
            if ($post->slug === 'laravel-10-tutorial') {
                $post->tags()->attach([1, 2]);
            } elseif ($post->slug === 'vuejs-3-learning') {
                $post->tags()->attach([3, 4]);
            }
        }
    }
}