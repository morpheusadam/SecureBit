<?php
namespace Database\Seeders;

use App\Models\User\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            // User permissions
            ['group' => 'users', 'name' => 'view-users', 'title' => 'View Users'],
            ['group' => 'users', 'name' => 'create-users', 'title' => 'Create Users'],
            ['group' => 'users', 'name' => 'edit-users', 'title' => 'Edit Users'],
            ['group' => 'users', 'name' => 'delete-users', 'title' => 'Delete Users'],
            
            // Role permissions
            ['group' => 'roles', 'name' => 'view-roles', 'title' => 'View Roles'],
            ['group' => 'roles', 'name' => 'create-roles', 'title' => 'Create Roles'],
            ['group' => 'roles', 'name' => 'edit-roles', 'title' => 'Edit Roles'],
            ['group' => 'roles', 'name' => 'delete-roles', 'title' => 'Delete Roles'],
            
            // Post permissions
            ['group' => 'posts', 'name' => 'view-posts', 'title' => 'View Posts'],
            ['group' => 'posts', 'name' => 'create-posts', 'title' => 'Create Posts'],
            ['group' => 'posts', 'name' => 'edit-posts', 'title' => 'Edit Posts'],
            ['group' => 'posts', 'name' => 'delete-posts', 'title' => 'Delete Posts'],
            ['group' => 'posts', 'name' => 'publish-posts', 'title' => 'Publish Posts'],
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }
}