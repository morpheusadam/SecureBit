<?php
namespace Database\Seeders;

use App\Models\User\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            [
                'name' => 'super-admin',
                'title' => 'Super Administrator',
                'level' => 100,
                'is_active' => true
            ],
            [
                'name' => 'admin',
                'title' => 'Administrator',
                'level' => 90,
                'is_active' => true
            ],
            [
                'name' => 'editor',
                'title' => 'Editor',
                'level' => 50,
                'is_active' => true
            ],
            [
                'name' => 'author',
                'title' => 'Author',
                'level' => 40,
                'is_active' => true
            ],
            [
                'name' => 'user',
                'title' => 'Regular User',
                'level' => 10,
                'is_active' => true
            ]
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}