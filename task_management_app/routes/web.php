<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\SocialiteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\User\TaskController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\HelpController;
use App\Http\Controllers\UserController;

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

Route::get('profile', [UserController::class, 'index'])->name('profile');
Route::get('cancel-update', [UserController::class, 'cancel'])->name('cancel.update');
Route::get('profile-update', [UserController::class, 'showUpdateProfileView'])->name('update.profile');
Route::post('profile-update', [UserController::class, 'storeUpdatedProfile'])->name('store.update');
Route::get('change-password', [UserController::class, 'showChangePasswordView'])->name('change.password');
Route::post('change-password', [UserController::class, 'storeChangedPassword']);

/**
 * used a get method for testing because logout button wasnt created
 * Will later switch to post after its been created 
 */
Route::get('logout', [LogoutController::class, 'logout'])->name('logout');

// Routes to show the task page and also store a task in the database
Route::get('tasks', [TaskController::class, 'index'])->name('tasks');
Route::post('{id}/task/store', [TaskController::class, 'store'])->name('store.task');
Route::get('search', [TaskController::class, 'search'])->name('search.task');
Route::get('task/{id}', [TaskController::class, 'showTaskDetails'])->name('show.task.details');
Route::get('task/{id}/delete', [TaskController::class, 'destroy'])->name('delete.task');
Route::get('task/{id}/update', [TaskController::class, 'updateTask'])->name('update.task');
Route::post('task/{id}/update', [TaskController::class, 'storeUpdatedTask']);


Route::get('settings', [SettingsController::class, 'index'])->name('settings');


Route::get('help', [HelpController::class, 'index'])->name('help');
