<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Rules\PasswordComplexity;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $user = Auth::user();
        return view('user.profile', ['user' => $user]);
    }

    public function showUpdateProfileView()
    {
        $user = Auth::user();
        return view('settings.update-profile', ['user' => $user]);
    }

    public function showChangePasswordView()
    {
        $user = Auth::user();
        return view('settings.change-password', ['user' => $user]);
    }

    public function storeUpdatedProfile(Request $request)
    {
        $user = Auth::user();

        $currentUser = User::where('email', $user->email);

        switch ($request) {
            case $request->first_name != null:
                $currentUser->update($request->only('first_name'));
            case $request->last_name != null:
                $currentUser->update($request->only('last_name'));
            case $request->email != null:
                $currentUser->update($request->only('email'));
        }
        return back();
    }
    public function cancel()
    {
        return back();
    }

    public function storeChangedPassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'old_password' => 'required',
            'password' => ['required', 'confirmed', new PasswordComplexity()],
        ]);

        $user = User::find($user->id);
        try {
            if (Hash::check($request->old_password, $user->password)) {
                $user->update(['password' => Hash::make($request->password)]);
                Auth::logut();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
            } else {
                return back()->with(['status' => 'Incorrect password']);
            }
        } catch (Exception $e) {
            return back()->with(['status' => 'Error occurred while changing password']);
        }
    }
}
