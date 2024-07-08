<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\MeasurementController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TailorController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\Auth\OtpController;
use Illuminate\Support\Facades\Route;


Route::view('/', 'index')->name('home');

// OTP Route
Route::controller(OtpController::class)->group(function () {
  Route::get('otp/login', 'index')->name('otp.login');
  Route::post('otp/generate', 'generate')->name('otp.generate');
  Route::get('otp/verification', 'verification')->name('otp.verification');
  Route::post('otp/login', 'loginWithOtp')->name('otp.getLogin');
  Route::post('otp/resend', 'resendOtp')->name('otp.resend');
});

// Guest Routes
Route::middleware('role:Guest')->group(function () {
  Route::get('login', [LoginController::class, 'index'])->name('login');
  Route::post('login', [LoginController::class, 'login'])->name('auth.login');

  Route::get('register', [RegisterController::class, 'index'])->name('register');
  Route::post('register', [RegisterController::class, 'register'])->name('auth.register');
});

// Logout route
Route::post('logout', [UserController::class, 'logout'])->name('logout');

// Admin Routes
Route::middleware(['role:Admin'])->group(function () {
  Route::resource('user', UserController::class);
  Route::resource('role', RoleController::class);
  Route::resource('admin', AdminController::class);
});

//  Customer Routes
Route::middleware(['role:Customer'])->group(function () {
  Route::controller(CustomerController::class)->group(function () {
    Route::get('home', 'customerDashboard')->name('customer.dashboard');
    Route::get('profile', 'Profile')->name('customer.profile');
    Route::post('profile', 'UpdateProfile')->name('customer.update_profile');
  });
});

//  Tailor Routes
Route::middleware(['role:Tailor'])->group(function () {
  Route::controller(TailorController::class)->group(function () {
    Route::get('tailor/dashboard', 'tailorDashboard')->name('tailor.dashboard');
  });
});

// Global Routes
Route::middleware('role:Admin,Customer,Tailor')->group(function () {
  Route::get('measurements/{user}', [MeasurementController::class, 'show'])->name('measurements.show');
  Route::post('measurements/{user}', [MeasurementController::class, 'store'])->name('measurements.store');
});

//  Admin && Customer/Tailor Routes
Route::middleware(['role:Customer,Tailor'])->group(function () {
  Route::get('/default', [UserController::class, 'defaultDashboard'])->name('default.dashboard');
});
