<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();

        // Assign roles to specific users
        $roleAssignments = [
            // Super Admin
            ['user_id' => 1, 'role_id' => 1, 'assigned_by' => 1],
            
            // Admin
            ['user_id' => 2, 'role_id' => 2, 'assigned_by' => 1],
            
            // Editor
            ['user_id' => 3, 'role_id' => 3, 'assigned_by' => 1],
            
            // Author
            ['user_id' => 4, 'role_id' => 4, 'assigned_by' => 1],
            
            // Regular Users (assign 'user' role)
            ['user_id' => 5, 'role_id' => 5, 'assigned_by' => 1],
            ['user_id' => 6, 'role_id' => 5, 'assigned_by' => 1],
            ['user_id' => 7, 'role_id' => 5, 'assigned_by' => 1],
            ['user_id' => 8, 'role_id' => 5, 'assigned_by' => 1],
            ['user_id' => 9, 'role_id' => 5, 'assigned_by' => 1],
            ['user_id' => 10, 'role_id' => 5, 'assigned_by' => 1],
            ['user_id' => 11, 'role_id' => 5, 'assigned_by' => 1],
            ['user_id' => 12, 'role_id' => 5, 'assigned_by' => 1],
            ['user_id' => 13, 'role_id' => 5, 'assigned_by' => 1],
            ['user_id' => 14, 'role_id' => 5, 'assigned_by' => 1],
            ['user_id' => 15, 'role_id' => 5, 'assigned_by' => 1],
        ];

        // Clear existing role assignments if needed
        DB::table('user_role')->truncate();

        // Insert role assignments
        foreach ($roleAssignments as $assignment) {
            DB::table('user_role')->insert([
                'user_id' => $assignment['user_id'],
                'role_id' => $assignment['role_id'],
                'assigned_at' => $now,
                'assigned_by' => $assignment['assigned_by'],
                'created_at' => $now,
                'updated_at' => $now
            ]);
        }

        // Update user profiles for the main roles
        $profileUpdates = [
            // Super Admin
            [
                'user_id' => 1,
                'full_name' => 'Super Administrator',
                'bio' => 'System super administrator with full access',
                'avatar_url' => 'https://ui-avatars.com/api/?name=Super+Admin&background=random'
            ],
            
            // Admin
            [
                'user_id' => 2,
                'full_name' => 'Administrator',
                'bio' => 'System administrator with management access',
                'avatar_url' => 'https://ui-avatars.com/api/?name=Admin&background=random'
            ],
            
            // Editor
            [
                'user_id' => 3,
                'full_name' => 'Content Editor',
                'bio' => 'Content editor with publishing permissions',
                'avatar_url' => 'https://ui-avatars.com/api/?name=Editor&background=random'
            ],
            
            // Author
            [
                'user_id' => 4,
                'full_name' => 'Content Author',
                'bio' => 'Content author with creation permissions',
                'avatar_url' => 'https://ui-avatars.com/api/?name=Author&background=random'
            ],
            
            // Regular User
            [
                'user_id' => 5,
                'full_name' => 'Regular User',
                'bio' => 'Standard system user',
                'avatar_url' => 'https://ui-avatars.com/api/?name=User&background=random'
            ]
        ];

        // Update profiles for main users
        foreach ($profileUpdates as $update) {
            DB::table('user_profiles')->updateOrInsert(
                ['user_id' => $update['user_id']],
                [
                    'full_name' => $update['full_name'],
                    'bio' => $update['bio'],
                    'avatar_url' => $update['avatar_url'],
                    'settings' => json_encode(['theme' => 'light', 'notifications' => true]),
                    'created_at' => $now,
                    'updated_at' => $now
                ]
            );
        }
    }
}