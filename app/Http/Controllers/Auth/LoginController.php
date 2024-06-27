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
            $roles = Auth::user()->roles->pluck('role');

            // Check the user's role and redirect
            if ($roles->contains('admin') && ($roles->contains('customer') || $roles->contains('tailor'))) {
                return redirect()->route('default.dashboard');
            } elseif ($roles->contains('admin')) {
                return redirect()->route('admin.dashboard');
            } elseif ($roles->contains('customer')) {
                return redirect()->route('customer.dashboard');
            } elseif ($roles->contains('tailor')) {
                return redirect()->route('tailor.dashboard');
            } else {
                // auth user but with no roles
                session()->flush();
                return redirect()->route('login')->with('status', 'You can no access this email address.');
            }
        }
        return redirect()->back()->withInput()->with('status', 'Username or Password is invalid.');
    }
}
