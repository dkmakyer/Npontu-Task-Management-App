<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $date = Date::hasFormat(Date::now(), 'Y-m-d');
        return view('user.my_profile');
    }

    public function updateProfile()
    {
        return view('settings.update_info');
    }

    public function changePassword()
    {
        return view('settings.change_password');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
        ]);

        try {
            User::where('email', '=', Auth::user()->email)->update($request->only('email', 'first_name', 'last_name'));
            return back()->with(['status' => 'Profile updated successfully']);
        } catch (Exception $e) {
            return back()->with(['error' => 'Failed to update to profile']);
        }
    }
    public function cancel()
    {
        return back();
    }
}
