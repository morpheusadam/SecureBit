<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            PermissionSeeder::class,
            RolePermissionSeeder::class,
            UserSeeder::class,
            UserRoleSeeder::class,
            UserSocialAccountSeeder::class,
            UserTokenSeeder::class,

              // Blog module seeders
            // Blog module seeders (in proper order)
            BlogCategorySeeder::class,
            BlogTagSeeder::class,
            BlogPostSeeder::class,
            BlogPostTagSeeder::class,
            BlogCommentSeeder::class,
            BlogPostViewSeeder::class,
            BlogPostMetaSeeder::class,
            BlogBookmarkSeeder::class,
        ]);
    }
}