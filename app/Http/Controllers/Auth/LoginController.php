<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();

            // دریافت کاربر لاگین کرده
            $user = Auth::user();

            // بررسی فعال بودن کاربر
            if (!$user->is_active) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return back()->withErrors([
                    'email' => 'حساب کاربری شما غیرفعال شده است.',
                ])->onlyInput('email');
            }

            // هدایت بر اساس نقش کاربر
            if ($user->hasRole('Administrator') || $user->hasRole('super-admin')) {
                return redirect()->intended('dashboard');
            }

            // برای کاربران عادی به صفحه اصلی سایت
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'اطلاعات وارد شده معتبر نمی‌باشد.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}