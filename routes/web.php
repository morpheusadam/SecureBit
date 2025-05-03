<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('auth')->group(function () {
    Route::get('login', 'App\Http\Controllers\Auth\LoginController@index')->name('login.show');
    Route::post('login', 'App\Http\Controllers\Auth\LoginController@store')->name('login.store');
    Route::post('logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');


    Route::get('register', 'App\Http\Controllers\Auth\RegisterController@index')->name('register.show');
    Route::post('register', 'App\Http\Controllers\Auth\RegisterController@store')->name('register.store');

    Route::get('/', function(){ return 'welcome';})->name('dashboard');

 });
