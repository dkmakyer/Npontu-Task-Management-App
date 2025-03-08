<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class SocialiteController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }
    public function redirectLogin(string $social)
    {
        return Socialite::driver($social)->redirect();
    }

    public function getSocialUser(string $social)
    {
        $user = Socialite::driver($social)->user();
        $user = User::updateOrCreate(
            [
                'social_id' => $user->id,
            ],
            [
                'first_name' => $user->user['given_name'],
                'last_name' => $user->user['family_name'],
                'username' => $user->name,
                'email' => $user->email,
                'password' => Hash::make('WelcomeNewUser123'),
            ]
        );
        Auth::login($user);
        return redirect(route('home'));
    }
}
