<?php

use Illuminate\Support\Facades\Route;

Route::get('/hello', function () {
    return 'Hello World from Auth Module!';
})->name('auth.hello');



Route::prefix('auth')->name('auth.')->group(function () {
    Route::get('/register', [\Modules\Auth\Http\Controllers\RegisterController::class, 'index'])->name('register.index');
    // Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
    // Route::get('/login', [LoginController::class, 'index'])->name('login.index');
    // Route::post('/login', [LoginController::class, 'store'])->name('login.store');
});