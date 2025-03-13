<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\SocialiteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\ReminderController;
use App\Http\Controllers\User\TaskController;

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'store']);

/**
 * routes to serve the request to login to the app using any provider
 * provider parameter refers to the name of the login provider
 * to make the route dynamic
 */
Route::get('auth/redirect/{provider}', [SocialiteController::class, 'providerLogin'])->name('social.login');
Route::get('auth/callback/{provider}', [SocialiteController::class, 'providerUser']);

Route::get('register', [RegisterController::class, 'index'])->name('register');
Route::post('register', [RegisterController::class, 'store']);

/**
 * used a get method for testing because logout button wasnt created
 * Will later switch to post after its been created 
 */
Route::get('logout', [LogoutController::class, 'logout'])->name('logout');
Route::resource('tasks', TaskController::class);
Route::resource('reminders', ReminderController::class);



