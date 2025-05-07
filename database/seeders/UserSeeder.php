<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // کاربر سوپر ادمین
        $superAdmin = User::create([
            'email' => 'superadmin@example.com',
            'username' => 'superadmin',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'is_active' => true
        ]);

        UserProfile::create([
            'user_id' => $superAdmin->id,
            'full_name' => 'Super Admin',
            'bio' => 'System Super Administrator',
            'avatar_url' => 'https://i.pravatar.cc/300?u=superadmin',
            'settings' => json_encode([])
        ]);

        // کاربر ادمین
        $admin = User::create([
            'email' => 'admin@example.com',
            'username' => 'admin',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'is_active' => true
        ]);

        UserProfile::create([
            'user_id' => $admin->id,
            'full_name' => 'Administrator',
            'bio' => 'System Administrator',
            'avatar_url' => 'https://i.pravatar.cc/300?u=admin',
            'settings' => json_encode([])
        ]);

        // کاربران نمونه
        $roles = ['editor', 'author', 'user'];
        
        foreach ($roles as $role) {
            $user = User::create([
                'email' => "$role@example.com",
                'username' => $role,
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'is_active' => true
            ]);

            UserProfile::create([
                'user_id' => $user->id,
                'full_name' => ucfirst($role),
                'bio' => "This is a sample $role account",
                'avatar_url' => "https://i.pravatar.cc/300?u=$role",
                'settings' => json_encode([])
            ]);
        }

        // کاربران تصادفی
        User::factory(10)->create()->each(function ($user) {
            UserProfile::factory()->create(['user_id' => $user->id]);
        });
    }
}