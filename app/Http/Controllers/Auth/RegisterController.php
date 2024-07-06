<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Gender;

class RegisterController extends Controller
{
    public function index()
    {
        $roles = Role::where('role', '!=', 'Admin')->get();
        $genders = Gender::get();
        return view('auth.register', compact('roles', 'genders'));
    }

    public function register(Request $req)
    {
        $credentials = $req->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
            'role' => 'required',
            'phone' => 'required|unique:users|numeric|regex:/^1[3-9][0-9]{8}$/',
            'gender' => 'required',
            'address' => 'required|string|max:255'
        ]);

        $countryCode = "+880";
        $credentials['phone'] = $countryCode . $credentials['phone'];
        $role = $credentials['role'];
        unset($credentials['role']);
        $user = User::create($credentials);

        if (!$user) {
            redirect()->back()->with('error', 'Unable to create an account.');
        }

        // Attach roles to the user
        $user->roles()->attach($role);
        //  Generate Otp then send it to an email
        $generateOtp = new OtpController();
        $generateOtp->generateForEmail($credentials);
        return redirect()->route('otp.verification')->with('success', 'OTP has been sent to your Email.');
    }
}
