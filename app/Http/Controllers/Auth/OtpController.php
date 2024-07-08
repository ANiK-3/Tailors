<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Mail\SendEmail;
use App\Models\User;
use App\Models\UserOtp;
use Twilio\Rest\Client;
use Exception;


class OtpController extends Controller
{
    public function index()
    {
        return view('auth.otp_login');
    }

    public function generate(Request $req)
    {
        $phone = $req->validate([
            'phone' => 'required|regex:/^1[3-9][0-9]{8}$/'
        ]);
        $countryCode = "+880";
        $phoneWithCC = $countryCode . $phone['phone'];
        $user = User::where('phone', $phoneWithCC)->first();

        if (!$user) {
            return redirect()->route('otp.login')->with('error', 'User not found');
        }
        // Prevent generating OTP if email is not verified
        if (is_null($user->email_verified_at)) {
            return redirect()->route('otp.login')->with('error', 'Email is not verified, Please verify.');
        }

        $otp = rand(123456, 999999); // generate random 6 digit otp
        $latestOtp = $user->otps()->latest()->first();

        if (!$latestOtp || now()->isAfter($latestOtp->otp_expires_at)) {
            $insertOtp = $user->otps()->create([
                'user_id' => $user->id,
                'otp' => $otp,
                'otp_expires_at' => now()->addMinutes(10),
            ]);
            // dd("inserted otp: " . $insertOtp->otp);
            $this->sendSMS($phoneWithCC, $insertOtp->otp);
        }

        if ($latestOtp && now()->isBefore($latestOtp->otp_expires_at)) {
            // dd("Latest otp: " . $latestOtp->otp);
            $this->sendSMS($phoneWithCC, $latestOtp->otp);
        }

        // Store user ID in session
        session([
            'otp_data' => $phone['phone'],
            'contactMethod' => 'phone'
        ]);

        return redirect()->route('otp.verification')->with('success', 'OTP has been sent to your phone.');
    }

    public function generateForEmail($credentials)
    {
        $email = $credentials['email'];
        $user = User::where('email', $email)->first();
        // not available any otp
        // already available but not expired
        //already available but expired

        if (!$user) {
            return redirect()->route('otp.login')->with('error', 'User not found');
        }

        $otp = rand(123456, 999999); // generate random 6 digit otp
        $latestOtp = $user->otps()->latest()->first();

        if (!$latestOtp || now()->isAfter($latestOtp->otp_expires_at)) {
            $insertOtp = $user->otps()->create([
                'user_id' => $user->id,
                'otp' => $otp,
                'otp_expires_at' => now()->addMinutes(10),
            ]);
            // dd("inserted otp: " . $insertOtp->otp);
            Mail::to($email)->send(new SendEmail('OTP', "Your OTP is {$insertOtp->otp}"));
        }

        if ($latestOtp && now()->isBefore($latestOtp->otp_expires_at)) {
            // dd("Latest otp: " . $latestOtp->otp);
            Mail::to($email)->send(new SendEmail('OTP', "Your OTP is {$latestOtp->otp}"));
        }

        // Store user ID in session
        session([
            'otp_data' => $email,
            'contactMethod' => 'email'
        ]);
        return redirect()->route('otp.verification')->with('success', 'OTP has been sent to your Email.');
    }

    public function verification()
    {
        return view('auth.otp_verification');
    }

    public function loginWithOtp(Request $req)
    {
        $otp = $req->validate([
            'otp' => 'required|numeric',
        ]);

        $userOtp = UserOtp::where('otp', $otp['otp'])->first();

        // Check if OTP is found
        if (!$userOtp) {
            return redirect()->back()->with('error', 'Your OTP is not correct');
        }
        // Check if OTP has expired
        if (now()->isAfter($userOtp->otp_expires_at)) {
            return redirect()->back()->with('error', 'Your OTP has expired');
        }

        $user = $userOtp->user;

        // Clear all OTPs for the user
        $user->otps()->delete();

        // Set email_verified_at if it's null
        if (is_null($user->email_verified_at)) {
            $user->update([
                'email_verified_at' => now(),
            ]);
        }

        // Log in the user
        Auth::login($user);

        // Check the user's role and redirect accordingly
        if (Gate::allows('admin') && Gate::any(['customer', 'tailor'])) {
            return redirect()->route('default.dashboard')->with('success', 'Login Successful');
        } elseif (Gate::allows('admin')) {
            return redirect()->route('admin.index')->with('success', 'Login Successful');
        } elseif (Gate::allows('customer')) {
            return redirect()->route('customer.dashboard')->with('success', 'Login Successful');
        } elseif (Gate::allows('tailor')) {
            return redirect()->route('tailor.dashboard')->with('success', 'Login Successful');
        }
        return redirect()->route('otp.login')->with('error', 'You can not access this account.');
    }

    public function resendOtp(Request $req)
    {
        // $contactMethod = $req->input('contactMethod'); // 'email' or 'phone'
        $contactMethod = session('contactMethod');
        $otpData = session('otp_data');

        if ($contactMethod == 'phone') {
            $phone = "+880" . $otpData;
            $user = User::where('phone', $phone)->first();
            if (!$user) {
                return redirect()->back()->with('error', 'Unable to resend OTP. Please try again.');
            }
            $response = $this->generate($req);
        } else {
            $email = $otpData;
            $user = User::where('email', $email)->first();
            if (!$user) {
                return redirect()->back()->with('error', 'Unable to resend OTP. Please try again.');
            }
            $credentials = ['email' => $email];
            $response = $this->generateForEmail($credentials);
        }
        // logger('Resend OTP Response', ['response' => $response]);
        return redirect()->route('otp.verification')->with('success', 'OTP has been resent.');
    }

    public function sendSMS($phone, $otp)
    {
        $message = "Login OTP is {$otp}";

        try {
            $account_id = env("TWILIO_SID");
            $auth_token = env("TWILIO_TOKEN");
            $twilo_number = env("TWILIO_FROM");

            $client = new Client($account_id, $auth_token);

            $client->messages->create($phone, [
                'from' => $twilo_number,
                'body' => $message,
            ]);
            info('SMS Sent successfully!');
            logger('SMS Sent', ['phone' => $phone, 'otp' => $otp]);
        } catch (Exception $e) {
            logger('SMS Sending Failed', ['error' => $e->getMessage()]);
        }
    }
}
