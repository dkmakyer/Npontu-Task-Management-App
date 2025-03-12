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
    public function providerLogin(string $social)
    {
        return Socialite::driver($social)->redirect();
    }

    public function providerUser(string $social)
    {

        $providerUser = Socialite::driver($social)->user();
        $user = User::where('social_id', $providerUser->id)->first();
        if ($user) {
            Auth::login($user);
            return redirect(route('dashboard'));
        }
        $user = User::create(
            [
                'first_name' => $providerUser->user['given_name'],
                'last_name' => $providerUser->user['family_name'],
                'username' => $providerUser->name,
                'email' => $providerUser->email,
                'social_id' => $providerUser->id,
                'password' => Hash::make('WelcomeNewUser123'),
            ]
        );
        Auth::login($user);
        return redirect(route('dashboard'));
    }
}
