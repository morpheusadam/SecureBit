<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\Auth\RegisterUserRequest;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(RegisterUserRequest $request)
    {
        $user = User::create([
            'name' => $request->validated()['name'],
            'email' => $request->validated()['email'],
            'password' => bcrypt($request->validated()['password']),
        ]);

        auth()->login($user);

        return redirect()->route('login.show')
            ->with('success', 'ثبت نام با موفقیت انجام شد! در حال انتقال به صفحه ورود...');
    }
}
