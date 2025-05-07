<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\User\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/debug-asset-paths', function() {
    return response()->json([
        'APP_URL' => config('app.url'),
        'Current_URL' => url()->current(),
        'Full_URL' => url()->full(),
        'Asset_Path' => asset('test-asset.txt'),
        'Request_Scheme' => request()->getScheme(),
        'Request_Host' => request()->getHost(),
        'Request_Port' => request()->getPort(),
        'Base_Path' => app('url')->asset(''),
        'Route_Current' => optional(request()->route())->uri(),
        'Middleware' => optional(request()->route())->gatherMiddleware(),
    ]);
});

Route::get('/final-debug', function() {
    $generator = app('url');
    
    return response()->json([
        'Generator_Class' => get_class($generator),
        'Generator_Root' => $generator->getRootControllerNamespace(),
        'Force_Root' => $generator->getForceScheme(),
        'Cached_Routes' => app('router')->getRoutes()->isCached(),
    ]);
});


// گروه بندی برای تمام مسیرهای مدیریتی
Route::prefix('dashboard')->name('dashboard.')->group(function () {
    
    // Dashboard Routes
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/analytics', 'analytics')->name('analytics');
    });
    
    // User Management Routes
    Route::prefix('users')->name('users.')->controller(UserController::class)->group(function () {
        // CRUD Routes
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{user}/edit', 'edit')->name('edit');
        Route::put('/{user}', 'update')->name('update');
        Route::delete('/{user}', 'destroy')->name('destroy');
        
        // Additional User Routes
        Route::get('/profile', 'profile')->name('profile');
        Route::get('/roles', 'roles')->name('roles');
        Route::post('/roles', 'assignRoles')->name('roles.assign');
        Route::get('/permissions', 'permissions')->name('permissions');
        Route::post('/permissions', 'syncPermissions')->name('permissions.sync');
        
        // Impersonation Routes
        Route::post('/{user}/impersonate', 'impersonate')->name('impersonate');
        Route::post('/leave-impersonate', 'leaveImpersonation')->name('leave-impersonate');
    });
    
    // سایر بخش‌های مدیریتی می‌توانند اینجا اضافه شوند
    // ...
});