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
            // check if user's email is verified
            if (Gate::denies('isVerified')) {
                $generateOtp = new OtpController();
                $generateOtp->generateForEmail($credentials);
                return redirect()->route('otp.verification')->with('success', 'OTP has been sent to your Email, please verify your email address.');
            }
            // Check the user's role and redirect accordingly
            if (Gate::allows('admin') && Gate::any(['customer', 'tailor'])) {
                return redirect()->route('default.dashboard')->with('success', 'Login Successful');
            } elseif (Gate::allows('admin')) {
                return redirect()->route('admin.index')->with('success', 'Login Successful');
            } elseif (Gate::allows('customer')) {
                return redirect()->route('customer.dashboard')->with('success', 'Login Successful');
            } elseif (Gate::allows('tailor')) {
                return redirect()->route('tailor.dashboard')->with('success', 'Login Successful');
            } elseif (Gate::none(['admin', 'customer', 'tailor'])) {
                // auth user but with no roles
                session()->flush();
                return redirect()->route('login')->with('error', 'You can not access this email address.');
            }
        }
        return redirect()->back()->withInput()->with('error', 'Username or Password is invalid.');
    }
}
