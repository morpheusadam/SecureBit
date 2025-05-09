<?php

namespace Database\Seeders;

use App\Models\Blog\Category;
use Illuminate\Database\Seeder;

class BlogCategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'name' => 'Technology',
                'slug' => 'technology',
                'description' => 'All about technology and innovation',
                'is_active' => true,
                'order' => 1
            ],
            [
                'name' => 'Programming',
                'slug' => 'programming',
                'description' => 'Programming languages and techniques',
                'parent_id' => 1,
                'is_active' => true,
                'order' => 1
            ],
            [
                'name' => 'Web Development',
                'slug' => 'web-development',
                'description' => 'Frontend and backend web development',
                'parent_id' => 1,
                'is_active' => true,
                'order' => 2
            ],
            [
                'name' => 'Lifestyle',
                'slug' => 'lifestyle',
                'description' => 'Daily life and personal development',
                'is_active' => true,
                'order' => 2
            ],
            [
                'name' => 'Travel',
                'slug' => 'travel',
                'description' => 'Travel experiences and guides',
                'parent_id' => 4,
                'is_active' => true,
                'order' => 1
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}