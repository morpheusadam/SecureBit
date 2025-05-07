<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = \App\Models\User::with(['roles', 'profile'])->get();
        return view('dashboard.userindex', compact('users'));
    }

    public function create()
    {
        return view('dashboard.users.create');
    }

    public function store(Request $request)
    {
        // منطق ذخیره کاربر جدید
    }

    public function edit($id)
    {
        $user = \App\Models\User::findOrFail($id);
        return view('dashboard.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        // منطق به‌روزرسانی کاربر
    }

    public function destroy($id)
    {
        // منطق حذف کاربر
    }
}