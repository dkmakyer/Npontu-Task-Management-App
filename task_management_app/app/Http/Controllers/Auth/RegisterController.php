<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Rules\PasswordComplexity;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }
    public function index()
    {
        return view('auth.register');
    }
    public function store(Request $request)
    {
        $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'username' => 'required|unique:users,username|max:255',
            'email' => 'required|unique:users,email',
            'password' => ['required', new PasswordComplexity(), 'confirmed'],
            'terms' => 'accepted',
        ]);

        try {
            User::create([
                'first_name' => $request->firstName,
                'last_name' => $request->lastName,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'email' => $request->email
            ]);
            // redirect the user to the login page 
            return redirect(route('login'));
        } catch (Exception $e) {
            return back()->with(['error' => 'Unexpected Error Occurred']);
        }
    }
}
