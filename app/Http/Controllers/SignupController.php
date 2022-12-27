<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SignupController extends Controller
{
    public function index()
    {
        return view('signup.signup');
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:50',
            'email' => 'required',
            'password' => 'required|min:4|max:12|confirmed',
            'password_confirmation' => 'required_with:password|same:password'
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);

        User::create($validatedData);

        return redirect('/login')->with('success', 'Registration successfull!');
    }
}
