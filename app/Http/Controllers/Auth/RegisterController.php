<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\UserProfile;
use App\Http\Requests\Auth\RegisterUserRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(RegisterUserRequest $request)
    {
        DB::beginTransaction();
        
        try {
            // ایجاد کاربر جدید
            $user = User::create([
                'username' => $request->username,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'is_active' => true,
            ]);

            // ایجاد پروفایل کاربر
            UserProfile::create([
                'user_id' => $user->id,
                'full_name' => $request->full_name,
            ]);

            // اختصاص نقش پیش‌فرض
            $defaultRole = Role::where('name', 'user')->first();
            $user->roles()->attach($defaultRole);

            // لاگین خودکار کاربر
            auth()->login($user);

            DB::commit();

            return redirect()->route('home')
                ->with('success', 'ثبت نام با موفقیت انجام شد! خوش آمدید.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Registration error: ' . $e->getMessage());
            
            return back()
                ->withInput()
                ->with('error', 'خطایی در ثبت نام رخ داد. لطفا مجددا تلاش کنید.');
        }
    }
}