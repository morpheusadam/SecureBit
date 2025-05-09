<?php

namespace Database\Seeders;

use App\Models\User\Permission;
use App\Models\User\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
    
        // دسترسی‌های سوپر ادمین
        $superAdmin = Role::where('name', 'super-admin')->first();
        $permissions = Permission::pluck('id')->toArray();
        foreach ($permissions as $permissionId) {
            DB::table('role_permission')->insert([
                'role_id' => $superAdmin->id,
                'permission_id' => $permissionId,
                'assigned_at' => now()
            ]);
        }

        // دسترسی‌های ادمین
        $admin = Role::where('name', 'admin')->first();
        $adminPermissions = Permission::whereNotIn('group', ['roles'])->pluck('id')->toArray();
        foreach ($adminPermissions as $permissionId) {
            DB::table('role_permission')->insert([
                'role_id' => $admin->id,
                'permission_id' => $permissionId,
                'assigned_at' => now()
            ]);
        }

        // دسترسی‌های ادیتور
        $editor = Role::where('name', 'editor')->first();
        $editorPermissions = Permission::whereIn('group', ['posts', 'comments'])
            ->orWhere('name', 'view-users')
            ->pluck('id')->toArray();
        foreach ($editorPermissions as $permissionId) {
            DB::table('role_permission')->insert([
                'role_id' => $editor->id,
                'permission_id' => $permissionId,
                'assigned_at' => now()
            ]);
        }

        // دسترسی‌های نویسنده
        $author = Role::where('name', 'author')->first();
        $authorPermissions = Permission::whereIn('name', [
            'view-posts', 'create-posts', 'edit-posts',
            'view-comments', 'create-comments'
        ])->pluck('id')->toArray();
        foreach ($authorPermissions as $permissionId) {
            DB::table('role_permission')->insert([
                'role_id' => $author->id,
                'permission_id' => $permissionId,
                'assigned_at' => now()
            ]);
        }
    }
}