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
                // return redirect()->route('admin.dashboard');
            } elseif ($roles->contains('admin')) {
                return redirect()->route('admin.dashboard');
            } elseif ($roles->contains('customer')) {
                return redirect()->route('customer.dashboard');
            } elseif ($roles->conatains('tailor')) {
                return redirect()->route('tailor.dashboard');
            }
        }
        return back()->with('status', 'Username or Password is invalid.');
    }
}
