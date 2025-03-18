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
        // we are redirecting the user to google's login page
        return Socialite::driver('google')->scopes(['https://www.googleapis.com/auth/calendar'])->with(['prompt' => 'consent', 'access_type' => 'offline'])->redirect();
    }

    public function callback()
    {
        // provided a file path for storing the token_json we receive from the users table 
        // this will be used in the calendar integration
        $filePath = 'google-calendar\oauth-token.json';

        $providerUser = Socialite::driver('google')->user();
        $user = User::with(relations: ['notifications', 'collaborators', 'tasks', 'completedTasks'])->where('social_id', $providerUser->id)->first();

        // making sure a user isn't created multiple times
        if ($user) {
            Auth::login($user);

            // we are inserting the access_token from google in the token_json field in the users table
            // this is used by the calendar service
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
        // if there is a refreshtoken, we save it in the database else we save null 
        $user->token_json = json_encode([
            'access_token' => $providerUser->token,
            'expires_in' => $providerUser->expiresIn,
            'refresh_token' => $providerUser->refreshToken ?? null,
        ]);
        $user->save();
        Storage::put($filePath, $user->token_json);
    }
}
