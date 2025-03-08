<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\LandingPageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LogoutController;

Route::get('/', [LandingPageController::class, 'index'])->name('home');

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'store']);

Route::get('auth/redirect/{social}', [SocialiteController::class, 'redirectLogin'])->name('social.login');
Route::get('auth/callback/{social}', [SocialiteController::class, 'getSocialUser']);

Route::get('register', [RegisterController::class, 'index'])->name('register');
Route::post('register', [RegisterController::class, 'store']);

// used a get method for testing because logout button wasnt created
// Will later switch to post after its been created 
Route::get('logout', [LogoutController::class, 'logout'])->name('logout');
