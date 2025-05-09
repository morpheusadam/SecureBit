<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User\Role;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  ...$roles
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = $request->user();

        // اگر کاربر لاگین نکرده باشد
        if (!$user) {
            return $this->redirectToLogin();
        }

        // بررسی فعال بودن کاربر
        if (!$user->is_active) {
            auth()->logout();
            return $this->redirectToLogin('حساب کاربری شما غیرفعال شده است.');
        }

        // بررسی نقش‌های درخواستی
        foreach ($roles as $role) {
            if ($this->checkUserRole($user, $role)) {
                return $this->handleAuthorizedUser($role, $request, $next);
            }
        }

        // اگر هیچ یک از نقش‌ها را نداشت
        return $this->accessDenied();
    }

    /**
     * بررسی نقش کاربر در دیتابیس
     *
     * @param  \App\Models\User\User  $user
     * @param  string  $role
     * @return bool
     */
    protected function checkUserRole($user, $role)
    {
        // بررسی وجود نقش در دیتابیس
        $dbRole = Role::where('name', $role)->first();
        
        if (!$dbRole) {
            return false;
        }

        // بررسی اینکه کاربر این نقش را دارد یا نه
        return $user->roles()->where('name', $role)->exists();
    }

    /**
     * مدیریت کاربر مجاز
     *
     * @param  string  $role
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    protected function handleAuthorizedUser($role, $request, $next)
    {
        // نقش‌های سطح بالا مستقیماً به route درخواستی دسترسی دارند
        if (in_array($role, ['Administrator', 'super-admin'])) {
            return $next($request);
        }

        // برای سایر نقش‌ها به صفحه مخصوص خودشان هدایت می‌شوند
        $redirectRoute = $this->getRoleRedirectRoute($role);
        
        if (!$request->routeIs($redirectRoute)) {
            return redirect()->route($redirectRoute);
        }

        return $next($request);
    }

    /**
     * دریافت مسیر هدایت بر اساس نقش
     *
     * @param  string  $role
     * @return string
     */
    protected function getRoleRedirectRoute($role)
    {
        // می‌توانید این مقادیر را از کانفیگ یا دیتابیس هم بخوانید
        $roleRoutes = [
            'admin' => 'admin.dashboard',
            'editor' => 'editor.panel',
            'user' => 'home',
            // سایر نقش‌ها
        ];

        return $roleRoutes[$role] ?? 'domain';
    }

    /**
     * هدایت به صفحه لاگین با پیام خطا
     *
     * @param  string|null  $message
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function redirectToLogin($message = null)
    {
        return redirect()->route('login.show')
            ->with('error', $message ?? 'برای دسترسی به این بخش باید وارد شوید.');
    }

    /**
     * پاسخ دسترسی غیرمجاز
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function accessDenied()
    {
        abort(403, 'شما مجوز دسترسی به این بخش را ندارید.');
    }
}