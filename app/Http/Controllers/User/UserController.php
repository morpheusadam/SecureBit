<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;
use Exception;

class UserController extends Controller
{
    public function index()
    {
        $users = \App\Models\User::with(['roles', 'profile'])->get();
        return view('dashboard.userindex', compact('users'));
    }

    public function create()
    {
        $roles = \App\Models\Role::all(); // یا هر روش دیگری که نقش‌ها را دریافت می‌کنید
        return view('dashboard.user-create', compact('roles'));
    }
 

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('dashboard.user-edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $rules = [
            'username' => ['required', 'max:255', Rule::unique('users')->ignore($user->id)],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => 'nullable|confirmed|min:8',
            'full_name' => 'nullable|max:255',
            'bio' => 'nullable',
            'is_active' => 'sometimes|boolean',
            'roles' => 'required|array|min:1',
            'roles.*' => 'exists:roles,id',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'remove_avatar' => 'sometimes|boolean'
        ];

        $validated = $request->validate($rules);

        DB::beginTransaction();

        try {
            $updateData = [
                'username' => $validated['username'],
                'email' => $validated['email'],
                'is_active' => $request->boolean('is_active'),
            ];

            // اگر رمز عبور جدید وارد شده
            if ($request->filled('password')) {
                $updateData['password'] = Hash::make($validated['password']);
            }

            $user->update($updateData);

            // بروزرسانی پروفایل
            if ($user->profile) {
                $user->profile->update([
                    'full_name' => $validated['full_name'] ?? null,
                    'bio' => $validated['bio'] ?? null
                ]);
            } else {
                $user->profile()->create([
                    'full_name' => $validated['full_name'] ?? null,
                    'bio' => $validated['bio'] ?? null
                ]);
            }

            // مدیریت آواتار
            if ($request->has('remove_avatar') && $user->avatar_url) {
                Storage::disk('public')->delete($user->avatar_url);
                $user->update(['avatar_url' => null]);
            }

            if ($request->hasFile('avatar')) {
                // حذف آواتار قبلی اگر وجود دارد
                if ($user->avatar_url) {
                    Storage::disk('public')->delete($user->avatar_url);
                }

                $path = $request->file('avatar')
                    ->storeAs('avatars', 'user_'.$user->id.'.'.$request->file('avatar')->extension(), 'public');
                $user->update(['avatar_url' => $path]);
            }

            // بروزرسانی نقش‌ها
            $user->roles()->sync($validated['roles']);

            DB::commit();

            return back()->with('success', 'اطلاعات کاربر با موفقیت به‌روزرسانی شد');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()
                ->withInput()
                ->withErrors(['error' => 'خطا در بروزرسانی کاربر: ' . $e->getMessage()]);
        }
    }

    public function destroy(User $user)
    {
        DB::beginTransaction();

        try {
            // حذف آواتار
            if ($user->avatar_url) {
                Storage::disk('public')->delete($user->avatar_url);
            }

            // حذف پروفایل
            if ($user->profile) {
                $user->profile->delete();
            }

            // حذف روابط نقش‌ها
            $user->roles()->detach();

            // حذف کاربر
            $user->delete();

            DB::commit();

            return redirect()
                ->route('dashboard.users.index')
                ->with('success', 'کاربر با موفقیت حذف شد');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()
                ->withErrors(['error' => 'خطا در حذف کاربر: ' . $e->getMessage()]);
        }
    }
    public function store(Request $request)
{
    // Validation rules
    $validationRules = [
        'username' => 'required|unique:users|max:255',
        'email' => 'required|email|unique:users|max:255',
        'password' => 'required|confirmed|min:8',
        'full_name' => 'nullable|max:255',
        'bio' => 'nullable',
        'is_active' => 'sometimes|boolean',
        'roles' => 'required|array|min:1',
        'roles.*' => 'exists:roles,id',
        'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
    ];

    // Custom error messages
    $customMessages = [
        'username.required' => 'Username is required.',
        'username.unique' => 'This username is already taken.',
        'username.max' => 'Username must not exceed 255 characters.',
        'email.required' => 'Email address is required.',
        'email.email' => 'Please enter a valid email address.',
        'email.unique' => 'This email is already registered.',
        'email.max' => 'Email must not exceed 255 characters.',
        'password.required' => 'Password is required.',
        'password.confirmed' => 'Password confirmation does not match.',
        'password.min' => 'Password must be at least 8 characters.',
        'full_name.max' => 'Full name must not exceed 255 characters.',
        'roles.required' => 'At least one role must be selected.',
        'roles.min' => 'At least one role must be selected.',
        'roles.*.exists' => 'Selected role is invalid.',
        'avatar.image' => 'Avatar must be an image file.',
        'avatar.mimes' => 'Avatar must be a JPEG, PNG, JPG, or GIF file.',
        'avatar.max' => 'Avatar size must not exceed 2MB.'
    ];

    // Validate request data
    $validatedData = $request->validate($validationRules, $customMessages);

    try {
        // Begin database transaction
        DB::beginTransaction();

        // Create user with default active status
        $user = User::create([
            'username' => $validatedData['username'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'is_active' => $request->has('is_active') ? $request->boolean('is_active') : true
        ]);

        // Create user profile if data exists
        if ($request->filled('full_name') || $request->filled('bio')) {
            $user->profile()->create([
                'full_name' => $validatedData['full_name'] ?? null,
                'bio' => $validatedData['bio'] ?? null
            ]);
        }

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            $extension = $request->file('avatar')->extension();
            $avatarPath = $request->file('avatar')
                ->storeAs('avatars', "user_{$user->id}_avatar.{$extension}", 'public');
            
            $user->update(['avatar_url' => $avatarPath]);
        }

        // Sync user roles
        $user->roles()->sync($validatedData['roles']);

        // Commit transaction
        DB::commit();

        return back()->with([
            'success' => 'کاربر جدید با موفقیت ساخته شد',
            'user_details' => [
                'name' => $user->full_name,
                'username' => $user->username
            ]
        ]);

    } catch (ValidationException $e) {
        // Validation errors
        return back()
            ->withErrors($e->validator)
            ->withInput();

    } catch (QueryException $e) {
        // Database errors
        DB::rollBack();
        Log::error('User creation failed: ' . $e->getMessage());
        
        return back()
            ->withInput()
            ->withErrors([
                'database' => 'A database error occurred. Please try again.'
            ]);

    } catch (Exception $e) {
        // General errors
        DB::rollBack();
        Log::error('Unexpected error in user creation: ' . $e->getMessage());
        
        return back()
            ->withInput()
            ->withErrors([
                'general' => 'An unexpected error occurred. Please try again later.'
            ]);
    }
}




}