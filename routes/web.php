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
use App\Http\Controllers\AppointmentController;
use Illuminate\Support\Facades\Route;
use App\Models\Tailor;

Route::get('/user/name/{name}', [UserController::class, 'getUser'])->name('user.get')->middleware('auth');
Route::get('/admin/manage-shop', [AdminController::class, 'manageShop'])->name('admin.manage_shop');
Route::get('/admin/manage-request', [AdminController::class, 'manageRequest'])->name('admin.show_manage_request');
Route::get('/admin/create-shop', [AdminController::class, 'showCreateShop'])->name('admin.show_create_shop');
Route::post('/admin/create-shop', [AdminController::class, 'createShop'])->name('admin.create_shop');

Route::get('/', function () {
  $tailors = Tailor::where('accepted_by_admin', 1)->get();
  return view('index', compact('tailors'));
})->name('home');

Route::get('about_us', function () {
  return view('about_us');
})->name('about_us');

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
    Route::get('profile', 'profile')->name('customer.profile');
    Route::get('profile/update', 'showUpdateProfile')->name('customer.show_update_profile');
    Route::post('profile/update', 'UpdateProfile')->name('customer.update_profile');

    Route::get('tailor/{id}/appointment', [AppointmentController::class, 'show'])->name('appointment.show');
    Route::post('appointment', [AppointmentController::class, 'create'])->name('appointment.create');
    Route::post('/appointments/{appointment}', [AppointmentController::class, 'updateStatus'])->name('appointment.updateStatus');
  });
});

Route::get('tailor/{id}', [TailorController::class, 'show'])->name('tailor.show')->middleware('auth');
Route::get('tailor/show/{id}', [AdminController::class, 'showTailor'])->name('tailor.show_info')->middleware('auth');
Route::post('admin/accept-tailor-request/{id}', [AdminController::class, 'acceptRequest'])->name('admin.accept_tailor_request')->middleware('auth');
Route::post('admin/decline-tailor-request{id}', [AdminController::class, 'declineRequest'])->name('admin.decline_tailor_request')->middleware('auth');

//  Tailor Routes
Route::middleware(['role:Tailor'])->group(function () {
  Route::controller(TailorController::class)->group(function () {
    Route::get('dashboard', 'tailorDashboard')->name('tailor.dashboard');
  });
});

// Global Routes
Route::middleware('role:Customer,Tailor')->group(function () {
  Route::get('measurements/{user}', [MeasurementController::class, 'show'])->name('measurements.show');
  Route::post('measurements/{user}', [MeasurementController::class, 'store'])->name('measurements.store');
});

//  Admin && Customer/Tailor Routes
Route::middleware(['role:Customer,Tailor'])->group(function () {
  Route::get('/default', [UserController::class, 'defaultDashboard'])->name('default.dashboard');
});
