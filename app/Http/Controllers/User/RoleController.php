<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::with(['parent', 'permissions'])
                    ->withCount('users')
                    ->orderBy('level')
                    ->latest()
                    ->paginate(10);
                    
        $permissions = Permission::orderBy('title')->get();
        
        return view('dashboard.roles.index', compact('roles', 'permissions'));
    }

    public function create()
    {
        $parentRoles = Role::where('is_active', true)
            ->orderBy('title')
            ->get();
            
        $permissions = Permission::orderBy('group')->orderBy('title')->get();
        $permissionGroups = $permissions->groupBy('group');
        
        return view('dashboard.roles.create', compact('parentRoles', 'permissionGroups'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:roles|max:255|alpha_dash',
            'title' => 'required|max:255',
            'description' => 'nullable',
            'is_default' => 'boolean',
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,id'
        ]);

        DB::beginTransaction();

        try {
            $role = Role::create($validated);
            
            if (isset($validated['permissions'])) {
                $role->permissions()->sync($validated['permissions']);
            }

            DB::commit();

            return redirect()->route('dashboard.users.roles.index')
                ->with('success', 'نقش جدید با موفقیت ایجاد شد');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()
                ->withErrors(['error' => 'خطا در ایجاد نقش: ' . $e->getMessage()]);
        }
    }

    public function edit(Role $role)
    {
        $roles = Role::where('id', '!=', $role->id)
                    ->orderBy('title')
                    ->get();
                    
        $permissions = Permission::orderBy('title')->get();
        
        return view('dashboard.roles.edit', compact('role', 'roles', 'permissions'));
    }

    public function update(Request $request, Role $role)
    {
        $validated = $request->validate([
            'name' => ['required', 'max:255', 'alpha_dash', Rule::unique('roles')->ignore($role->id)],
            'title' => 'required|max:255',
            'description' => 'nullable',
            'is_default' => 'boolean',
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,id'
        ]);

        DB::beginTransaction();

        try {
            $role->update($validated);
            
            if (isset($validated['permissions'])) {
                $role->permissions()->sync($validated['permissions']);
            }

            DB::commit();

            return redirect()->route('dashboard.users.roles.index')
                ->with('success', 'نقش با موفقیت به‌روزرسانی شد');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()
                ->withErrors(['error' => 'خطا در به‌روزرسانی نقش: ' . $e->getMessage()]);
        }
    }

    // ... (keep other methods the same)
}