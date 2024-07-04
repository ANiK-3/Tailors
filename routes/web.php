<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\Auth\OtpController;
use Illuminate\Support\Facades\Route;


Route::view('/', 'index')->name('home');

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('auth.login');

Route::get('register', [RegisterController::class, 'index'])->name('register');
Route::post('register', [RegisterController::class, 'register'])->name('auth.register');

Route::get('logout', [UserController::class, 'logout'])->name('logout');


// OTP Route
Route::controller(OtpController::class)->group(function () {
  Route::get('otp/login', 'index')->name('otp.login');
  Route::post('otp/generate', 'generate')->name('otp.generate');
  Route::get('otp/verification', 'verification')->name('otp.verification');
  Route::post('otp/login', 'loginWithOtp')->name('otp.getLogin');
  Route::post('otp/resend', 'resendOtp')->name('otp.resend');
});

// Email Verification Route
// Route::get('send-email/{email}', [EmailController::class, 'sendEmail']);
// Route::get('/email/verify', function () {
//   return view('auth.verify-email');
// })->middleware('auth')->name('verification');

// Guest Routes
Route::middleware('role:Guest')->group(function () {
  Route::get('login', [LoginController::class, 'index'])->name('login');
  Route::post('login', [LoginController::class, 'login'])->name('auth.login');

  Route::get('register', [RegisterController::class, 'index'])->name('register');
  Route::post('register', [RegisterController::class, 'register'])->name('auth.register');

  Route::get('logout', [UserController::class, 'logout'])->name('logout')->withoutMiddleware('role:Guest');
});


// Admin Routes
Route::middleware(['role:Admin'])->group(function () {
  Route::resource('user', UserController::class);
  Route::resource('role', RoleController::class);
  Route::get('admin/dashboard', [UserController::class, 'adminDashboard'])->name('admin.dashboard');
});


//  Customer Routes
Route::middleware(['role:Customer'])->group(function () {
  Route::get('/home', [UserController::class, 'customerDashboard'])->name('customer.dashboard');
  Route::get('profile/{id}', [UserController::class, 'customerProfile'])->name('customer.profile');
});


//  Tailor Routes
Route::middleware(['role:Tailor'])->group(function () {
  Route::get('tailor/dashboard', [UserController::class, 'tailorDashboard'])->name('tailor.dashboard');
});

//  Admin && Customer/Tailor Routes
Route::middleware(['role:Customer,Tailor'])->group(function () {
  Route::get('/default', [UserController::class, 'defaultDashboard'])->name('default.dashboard');
});
