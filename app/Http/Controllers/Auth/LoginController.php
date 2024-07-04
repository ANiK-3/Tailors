<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

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
            // Check the user's role and redirect accordingly
            if (Gate::allows('admin') && Gate::any(['customer', 'tailor'])) {
                return redirect()->route('default.dashboard');
            } elseif (Gate::allows('admin')) {
                return redirect()->route('admin.dashboard');
            } elseif (Gate::allows('customer')) {
                return redirect()->route('customer.dashboard');
            } elseif (Gate::allows('tailor')) {
                return redirect()->route('tailor.dashboard');
            } else {
                // auth user but with no roles
                session()->flush();
                return redirect()->route('login')->with('status', 'You can not access this email address.');
            }
        }
        return redirect()->back()->withInput()->with('status', 'Username or Password is invalid.');
    }
}
