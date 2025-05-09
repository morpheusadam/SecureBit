<?php

namespace Database\Seeders;

use App\Models\Blog\Tag;
use Illuminate\Database\Seeder;

class BlogTagSeeder extends Seeder
{
    public function run()
    {
        $tags = [
            ['name' => 'Laravel', 'slug' => 'laravel'],
            ['name' => 'PHP', 'slug' => 'php'],
            ['name' => 'JavaScript', 'slug' => 'javascript'],
            ['name' => 'VueJS', 'slug' => 'vuejs'],
            ['name' => 'React', 'slug' => 'react'],
            ['name' => 'CSS', 'slug' => 'css'],
            ['name' => 'HTML', 'slug' => 'html'],
            ['name' => 'Database', 'slug' => 'database'],
        ];

        foreach ($tags as $tag) {
            Tag::create($tag);
        }
    }
}