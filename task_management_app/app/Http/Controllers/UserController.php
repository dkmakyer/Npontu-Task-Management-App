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
        $message = null;
        switch ($request) {
            case $request->first_name != null:
                try {
                    $currentUser->update($request->only('first_name'));
                } catch (Exception $e) {
                    $message = "Failed to update profile and unexpected error occured";
                }
            case $request->last_name != null:
                try {
                    $currentUser->update($request->only('last_name'));
                } catch (Exception $e) {
                    $message = "Failed to update profile and unexpected error occured";
                }
            case $request->email != null:
                try {
                    $currentUser->update($request->only('email'));
                } catch (Exception $e) {
                    $message = "Failed to update profile and unexpected error occured";
                }
        }
        $message ?? "Profile updated successfully";
        return back()->with(['message' => $message]);
    }
    public function cancel()
    {
        return back();
    }

    public function storeChangedPassword(Request $request)
    {
        // get the authenticated user
        $user = Auth::user();

        // make sure the user fills in these specified fields and follows the convention
        $request->validate([
            'old_password' => 'required',
            'password' => ['required', 'confirmed', new PasswordComplexity()],
        ]);

        // go through the users table and get the user with an id of the authenticated users id
        $user = User::with(relations: ['notifications', 'collaborators', 'tasks', 'completedTasks'])->find($user->id);

        try {
            // check to see if the old password the user input is valid
            // if it is, then the user can continue with changing his or her password
            if (Hash::check($request->old_password, $user->password)) {
                $user->update(['password' => Hash::make($request->password)]);

                // logout the user after changing password to protect the account
                // and also invalidate his session to log him or her out of every device connected to
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
