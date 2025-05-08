<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\RoleController;

Route::prefix('dashboard')->name('dashboard.')->group(function () {
    
    // Dashboard Routes
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/analytics', 'analytics')->name('analytics');
    });
    
    // User Management Routes
    Route::prefix('users')->name('users.')->group(function () {
        // User CRUD Routes
        Route::controller(UserController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{user}/edit', 'edit')->name('edit');
            Route::put('/{user}', 'update')->name('update');
            Route::delete('/{user}', 'destroy')->name('destroy');
            
            // Impersonation Routes
            Route::post('/{user}/impersonate', 'impersonate')->name('impersonate');
            Route::post('/leave-impersonate', 'leaveImpersonation')->name('leave-impersonate');
            
            // Profile Route
            Route::get('/profile', 'profile')->name('profile');
        });
        
        // Role Management Routes (separate from UserController)
        Route::prefix('roles')->name('roles.')->controller(RoleController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{role}/edit', 'edit')->name('edit');
            Route::put('/{role}', 'update')->name('update');
            Route::delete('/{role}', 'destroy')->name('destroy');
            
            // Permission Management
            Route::get('/{role}/permissions', 'permissions')->name('permissions');
            Route::put('/{role}/permissions', 'syncPermissions')->name('sync-permissions');
            
            // Users with this role
            Route::get('/{role}/users', 'users')->name('users');
        });
    });
});