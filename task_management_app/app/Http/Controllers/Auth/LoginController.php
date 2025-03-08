<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }
    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        // if the login attempt was unsuccessful, return with an error message to the user 
        if (!Auth::attempt($request->only('username', 'password'), (bool)$request->remember)) {
            return back()->with(['error' => 'Invalid Credentials']);
        }
        return redirect(route('home'));
    }
}
