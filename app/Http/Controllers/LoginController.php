<?php

namespace App\Http\Controllers;

use App\Models\LoginLog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials)){
            $login = [
                'user_id' => auth()->user()->id,
                'is_online' => true
            ];
            LoginLog::create($login);

            $request->session()->regenerate();
            if(auth()->user()->role == 'admin'){
                return redirect('/admin');
            }
            return redirect()->intended();
        }

        return back()->with('error', 'Login Failed!');
    }

    public function logout(Request $request)
    {
        $log = LoginLog::latest()->where('user_id', auth()->user()->id)->get();
        $log[0]->is_online = false;
        $log[0]->save();

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
