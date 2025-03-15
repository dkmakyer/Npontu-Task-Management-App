<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }


    public function login()
    {

        return Socialite::driver('google')->scopes(['https://www.googleapis.com/auth/calendar'])->with(['prompt' => 'consent', 'access_type' => 'offline'])->redirect();
    }

    public function callback()
    {
        $filePath = 'google-calendar\oauth-token.json';

        $providerUser = Socialite::driver('google')->user();
        $user = User::where('social_id', $providerUser->id)->first();
        if ($user) {
            Auth::login($user);
            $this->saveTokenData($user, $providerUser, $filePath);
            return redirect(route('tasks'));
        } else {
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
            $this->saveTokenData($user, $providerUser, $filePath);
            return redirect(route('tasks'));
        }
    }

    public function saveTokenData($user, $providerUser, $filePath)
    {

        switch ($providerUser->refreshToken) {
            case null:
                $user->token_json = json_encode([
                    'access_token' => $providerUser->token,
                    'expires_in' => $providerUser->expiresIn,
                ]);
                $user->save();
                Storage::put($filePath, $user->token_json);

                break;
            default:
                $user->token_json = json_encode([
                    'access_token' => $providerUser->token,
                    'expires_in' => $providerUser->expiresIn,
                    'refresh_token' => $providerUser->refreshToken,
                ]);
                $user->save();
                Storage::put($filePath, $user->token_json);
        }
    }
}
