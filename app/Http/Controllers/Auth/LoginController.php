<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $req)
    {
        $credentials = $req->validate([
            'email' => 'required',
            'password' => 'required|min:8'
        ]);

        if (Auth::attempt($credentials, $req->has('remember'))) {
            return redirect()->route('dashboard');
        }
        return back()->with('status', 'The provided credentials do not match our records.');
    }

    public function dashboardPage()
    {
        if (Auth::check()) {
            return view('index');
        }
        return back()->with('status', 'Username or Password is invalid.');
    }
}
